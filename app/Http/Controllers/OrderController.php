<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
public function order($id)
    {
        // جلب الخدمة من قاعدة البيانات
        $service = Service::findOrFail($id);

$nurses = \App\Models\User::where('role', 'nurse')
                              ->where('Status', 'Available')
                              ->with('profile')
                              ->get();   // إرجاع واجهة صفحة الطلب (تأكدي من وجود الملف في المسار الصحيح)
   return view('Orders.order', compact('service', 'nurses'));
    }
public function store(Request $request)
{
    // 1. التحقق من البيانات (إجباري اختيار ممرض)
    $request->validate([
        'service_id'     => 'required|exists:services,ServiceID',
        'nurse_id'       => 'required|exists:users,UserID', // التأكد أن الممرض موجود
        'patients_count' => 'required|integer|min:1',
    ], [
        'nurse_id.required' => 'يرجى اختيار ممرض من القائمة لإتمام الطلب.',
    ]);

    $user = Auth::user();
    $service = Service::findOrFail($request->service_id);

    // 2. حساب السعر
    $totalPrice = $service->BasePrice * $request->patients_count;

    // إذا كانت الخدمة "رعاية"، نحسب بناءً على عدد الساعات
    if ($service->CategoryName == 'رعاية') {
        $totalPrice *= ($request->service_duration ?: 1);
    }

    // 3. تجهيز بيانات المريض (إما بيانات المستخدم الحالية أو بيانات مدخلة يدوياً)
    $patientInfo = [
        'name'    => $request->custom_patient_name ?: $user->Username,
        'phone'   => $request->custom_patient_phone ?: ($user->profile->PhoneNumber ?? 'غير متوفر'),
        'address' => $request->custom_patient_address ?: ($user->profile->Address ?? 'غير متوفر'),
    ];

    // 4. إنشاء الطلب في قاعدة البيانات
    $order = Order::create([
        'UserID'           => Auth::id(),
        'nurse_id'         => $request->nurse_id,       // الممرض المختار من السليدر
        'service_id'       => $request->service_id,
        'patients_count'   => $request->patients_count,
        'service_duration' => $request->service_duration ?? 1,
        'total_price'      => $totalPrice,
        'status'           => 'Pending',
        'review'           => json_encode($patientInfo), // تخزين بيانات المريض
    ]);

    // 5. التوجيه لصفحة تفاصيل الطلب مع رسالة نجاح
    return redirect()->route('orders.show', $order->id)
                     ->with('success', 'تم إرسال طلبك للممرض بنجاح! جاري الانتظار.');
}
public function show($id)
{
    $order = Order::findOrFail($id);
    $patientData = json_decode($order->review, true);

    // مرري $nurses فارغاً أو حسب الحاجة لتجنب الخطأ
    $nurses = collect();

    return view('Orders.order', compact('order', 'patientData', 'nurses'));
}
public function getStatusAttribute($value)
{
    $styles = [
        'Pending'     => ['text' => 'قيد الانتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
        'Accepted'    => ['text' => 'تم القبول', 'class' => 'bg-blue-100 text-blue-800'],
        'In-Progress' => ['text' => 'جاري العمل', 'class' => 'bg-purple-100 text-purple-800'],
        'Completed'   => ['text' => 'مكتمل', 'class' => 'bg-green-100 text-green-800'],
        'Cancelled'   => ['text' => 'ملغي', 'class' => 'bg-red-100 text-red-800'],
        'Hidden'      => ['text' => 'مخفي', 'class' => 'hidden'],
    ];

    return $styles[$value] ?? ['text' => $value, 'class' => 'bg-gray-100'];
}
public function myOrders()
{
    // جلب طلبات المستخدم الحالي مع بيانات الخدمة المرتبطة بها
    $orders = Order::where('UserID', Auth::id())
                   ->with('service')
                   ->latest() // لترتيب الطلبات من الأحدث للأقدم
                   ->get();

    // 2. جلب قائمة الخدمات (وهذا هو الجزء المفقود الذي يسبب الخطأ)
    $services = Service::all();

    // 3. جلب قائمة الممرضين
   $nurses = User::where('role', 'nurse')
              ->where('Status', 'Available')
              ->get();
    // 4. تمريرهم جميعاً إلى الصفحة
    return view('Orders.my-orders', compact('orders', 'services', 'nurses'));

}
// دالة عرض صفحة التعديل
public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // 1. تحديث البيانات الأساسية
    $order->update($request->only(['service_id', 'nurse_id', 'patients_count', 'service_duration']));

    // 2. إعادة حساب السعر (هذه هي الخطوة المفقودة)
    $service = Service::find($request->service_id);

    // معادلة حساب السعر (تأكدي من مطابقتها لمعادلتك الأصلية)
    $newPrice = $service->BasePrice * $request->patients_count * ($request->service_duration ?? 1);

    $order->total_price = $newPrice;
    $order->save(); // حفظ التعديل الجديد للسعر

    return redirect()->route('orders.my-orders')->with('success', 'تم تحديث الطلب والسعر بنجاح');
}
public function destroy(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // بدلاً من الحذف النهائي، نقوم بتحديث الحالة فقط
    if ($request->action_type == 'delete') {
        // حالة الحذف من الواجهة (المكتمل سابقاً)
        $order->update(['status' => 'Hidden']);
        $message = 'تمت إلازالة بنجاح.';
    } else {
        // حالة الإلغاء للطلبات غير المكتملة
        $order->update(['status' => 'Cancelled']);
        $message = 'تم إلغاء الطلب بنجاح.';
    }

    return back()->with('success', $message);
}
public function index()
{
    // يمكنكِ تحويل المستخدم لصفحة "طلباتي" الخاصة بكِ
    return redirect()->route('orders.my-orders');
}
public function storeRating(Request $request, $id)
{
    // تأكدي من أن الكود لا يقوم بعمل redirect أو view إطلاقاً
    $order = Order::findOrFail($id);
    $order->update(['rating' => $request->rating]);

    return response()->json(['success' => 'تم حفظ التقييم بنجاح!']);
}
// في OrderController.php
public function updateStatus(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->status = 'In-Progress'; // هنا تتحول الحالة لجاري العمل
    $order->save();
    return response()->json(['success' => true]);
}
public function updateStatu(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->status = 'Reject'; // هنا تتحول الحالة لجاري العمل
    $order->save();
    return response()->json(['success' => true]);
}

public function cancel($id)
{
    $order = \App\Models\Order::findOrFail($id);

    // تحديث الحالة إلى Cancelled
    $order->update(['status' => 'Cancelled']);

    return back()->with('success', 'تم إلغاء الطلب بنجاح');
}
public function confirmCancel(Request $request)
    {
        // 1. التحقق من وجود رقم الطلب
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        // 2. العثور على الطلب وتحديث حالته
        $order = Order::find($request->order_id);

        if ($order) {
            $order->update([
                'status' => 'Cancel' // أو أي اسم حالة تستخدمه في قاعدة البيانات
            ]);

            // اختياري: يمكنك إضافة رسالة نجاح
            return back()->with('success', 'تم تأكيد إلغاء الطلب بنجاح.');
        }

        return back()->with('error', 'حدث خطأ أثناء معالجة الطلب.');
    }
}

