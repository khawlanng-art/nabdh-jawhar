<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileUser;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NurseController extends Controller
{

public function index()
{
    $nurses = \App\Models\User::where('Role', 'Nurse')
  ->whereNotIn('Status', ['Pending', 'Suspended'])
       
        ->select('UserID', 'Username', 'Status')
        ->with(['profile:UserID,ProfilePicture,Specialization,Gender'])
        ->withAvg('orders', 'rating')
        ->paginate(8);
$orders = \App\Models\Order::where('nurse_id', Auth::id())->get();
    return view('Nurse.nurses', compact('nurses','orders'));
}
    public function show($id)
{
    // جلب بيانات الممرض مع علاقة الـ profile
    $nurse = \App\Models\User::with('profile')->findOrFail($id);

    // تمرير بيانات الممرض لصفحة البروفايل
    return view('Nurse.profilenurses', compact('nurse'));
}
public function dashboard()
{
  $notifications = \App\Models\Order::where('nurse_id', (Auth::id()))
                                      ->where('status', 'Pending')
                                      ->get();
$nurse = \App\Models\User::with(['profile'])
        ->withAvg('orders', 'rating')
        ->withCount('orders') // هذا سيعطيك $nurse->orders_count
        ->findOrFail(Auth::id());

    // 2. باقي الإحصائيات التي كنت تحسبها
    $nurseId = Auth::id();
    $newOrdersCount = \App\Models\Order::where('nurse_id', $nurseId)->where('status', 'Pending')->count();
    $acceptedOrdersCount = \App\Models\Order::where('nurse_id', $nurseId)->where('status', 'Accepted')->count();
    $completedOrdersCount = \App\Models\Order::where('nurse_id', $nurseId)->where('status', 'Completed')->count();
    // 2. تمريرها إلى الواجهة
   return view('Nurse.dashboard', compact('nurse', 'newOrdersCount', 'acceptedOrdersCount', 'completedOrdersCount','notifications'));

}
public function showReviews($id)
{
    // جلب الممرض مع تقييماته (الطلبات التي تمت ولها تقييم)
    $nurse = User::findOrFail($id);

    // نجلب فقط الطلبات التي تم الانتهاء منها (Completed) والتي تحتوي على تقييم
    $reviews = Order::where('nurse_id', $id)
                    ->where('status', 'Completed')
                    ->whereNotNull('rating') // شرط وجود تقييم
                    ->with('user') // لجلب بيانات المريض (صاحب الطلب)
                    ->latest()
                    ->get();

    return view('Nurse.reviews', compact('nurse', 'reviews'));
}
public function editProfile()
    {
        $nurse = Auth::user();
        return view('Nurse.ProfileEdit', compact('nurse'));
    }

    /**
     * معالجة تحديث بيانات الممرض
     */
    public function updateProfile(Request $request)
    {


        $request->validate([
            'Username'       => 'required|string|max:255',
            'PhoneNumber'    => 'nullable|string|max:20',
            'Address'        => 'nullable|string|max:500',
            'Gender'         => 'nullable|in:Male,Female',
            'Specialization' => 'nullable|string|max:255',
            'ProfilePicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'Status' => 'required|in:Available,Busy,Offline',
        ]);

        $nurse = User::find(Auth::id());
if (!$nurse) {
        return response()->json(['message' => 'الممرض غير موجود'], 404);
    }

        // 1. تحديث اسم المستخدم في جدول الـ Users
        $nurse->update(['Username' => $request->Username]);

        // 2. تحديث أو إنشاء الـ Profile في جدول الـ ProfileNurse
        // تأكد من اسم الموديل الخاص ببروفايل الممرض (مثلاً: ProfileNurse)

        $profile = $nurse->profile ?? new ProfileUser(['UserID' => Auth::id()]);
        $nurse->Status = $request->Status;
$nurse->save();
        $profile->fill($request->only(['PhoneNumber', 'Address', 'Gender', 'Specialization']));

        // 3. معالجة رفع الصورة
        if ($request->hasFile('ProfilePicture')) {
            // حذف الصورة القديمة إذا وجدت
            if ($profile->ProfilePicture) {
                Storage::disk('public')->delete($profile->ProfilePicture);
            }

            // تخزين الصورة الجديدة
            $filename = 'nurse_' . $nurse->id . '_' . time() . '.jpg';
            $path = $request->file('ProfilePicture')->storeAs('profiles', $filename, 'public');
            $profile->ProfilePicture = $path;
        }
if ($request->hasFile('ProfilePicture')) {
        $imageFile = $request->file('ProfilePicture');
        $filename = 'nurse_' . Auth::id() . '_' . time() . '.jpg';
        $path = public_path('storage/profiles/' . $filename);

        // تصغير الصورة وضغطها (نفس المنطق الاحترافي)
        $img = imagecreatefromstring(file_get_contents($imageFile->getRealPath()));
        $width = imagesx($img);
        $height = imagesy($img);

        $tmp = imagecreatetruecolor(400, 400); // الأبعاد الجديدة
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, 400, 400, $width, $height);

        // حفظ بجودة 60% لتقليل الحجم بشكل كبير
        imagejpeg($tmp, $path, 60);

        imagedestroy($img);
        imagedestroy($tmp);

        $profile->ProfilePicture = 'profiles/' . $filename;
    }

    if ($request->hasFile('HealthCertificate')) {
    // 1. حذف الشهادة القديمة إذا وجدت
    if ($profile->HealthCertificate) {
        Storage::disk('public')->delete($profile->HealthCertificate);
    }

    // 2. تخزين الملف الجديد داخل مجلد 'docs'
    // الملف سيُحفظ في: storage/app/public/docs/filename.pdf
    $path = $request->file('HealthCertificate')->store('docs', 'public');

    // 3. حفظ المسار في قاعدة البيانات
    $profile->HealthCertificate = $path;
}
        $profile->save();

    return redirect()->route('Nurse.dashboard')->with('success', 'تم تحديث بياناتك بنجاح!');
    }
    public function accept($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'In-Progress']);

        return back()->with('success', 'تم قبول الطلب بنجاح');
    }

    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Rejected']);

        return back()->with('success', 'تم رفض الطلب');
    }

public function showOrder($id)
{$nurseId = Auth::user()->UserID;
    // جلب الطلب مع بيانات الخدمة والمريض (المستخدم) والممرض
    $order = \App\Models\Order::with(['service', 'user', 'nurse.profile'])
                ->where('nurse_id', Auth::id()) // التأكد أن الطلب يخص هذا الممرض
                ->findOrFail($id);
$rejectedOrders = Order::where('nurse_id', $nurseId)
                               ->where('status', 'Cancelled')
                               ->get();
    // تحويل بيانات المريض من JSON إلى مصفوفة
    $patientData = json_decode($order->review, true);

    return view('Nurse.layoutnurse', compact('order', 'patientData','rejectedOrders'));
}
public function myOrders()
{
 $orders = Order::where('nurse_id', Auth::id())
               ->whereNotIn('status', ['hidden', 'Pending','In-Progress'])
                   ->latest()
                   ->paginate(10);

    return view('Nurse.nurseorder', compact('orders'));
}
public function someFunction($orderId)
{
    // 1. الحصول على الـ id الخاص بالممرض المسجل دخوله حالياً
    $currentNurseId = Auth::id();

    // 2. جلب الطلب المحدد لهذا الممرض
    $order = Order::where('id', $orderId)
                  ->where('nurse_id', $currentNurseId)
                  ->firstOrFail();

    return view('Nurse.nurseorder', compact('order'));

}
public function hideOrder($id)
{
    $order = Order::findOrFail($id);

    // تحديث الحالة فقط لإخفائه من الواجهة
    $order->update(['status' => 'hidden']);

    return back()->with('success', 'تم إخفاء السجل بنجاح.');
}
// في الـ Controller
public function acceptedOrders()
{
    $orders = Order::where('status','In-Progress')
                   ->where('nurse_id', Auth::id())
                   ->with(['service', 'user'])
                   ->get();

    return view('Nurse.Acceptedorder', compact('orders'));
}
public function completeOrder($id)
{
    $order = \App\Models\Order::where('nurse_id', Auth::id())
                              ->findOrFail($id);

    // تحديث الحالة إلى مكتمل
    $order->update(['status' => 'Completed']);

    return back()->with('success', 'تم إكمال الطلب بنجاح!');
}
public function searchNurs(Request $request)
{
    // استقبال المتغير الخاص بالممرض فقط
    $query = $request->input('nurse_search_filter');

    $orders = \App\Models\Order::where('nurse_id', Auth::id()) // البحث في طلبات هذا الممرض فقط
                   ->where(function($q) use ($query) {
                       $q->where('id', 'like', "%{$query}%")
                         ->orWhere('review', 'like', "%{$query}%")
                         ->orWhereHas('service', function($q) use ($query) {
                             $q->where('ServiceName', 'like', "%{$query}%");
                         });
                   })
                   ->latest()
                   ->paginate(15);

    return view('Nurse.searchnurs', compact('orders', 'query'));
}
public function cancelOrder($id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'Cancelled'
    ]);

    return response()->json([
        'success' => true,
        'message' => 'تمت المعاينه بنجاح'
    ]);
}
}
