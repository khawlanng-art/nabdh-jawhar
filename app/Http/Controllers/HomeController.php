<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Order;
use App\Models\Service; // تأكدي من استيراد الموديل
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
{
    // جلب آخر 4 خدمات مضافة فقط
   $services = \App\Models\Service::where('IsActive', 1)->latest()->take(4)->get();
$nurses = \App\Models\User::where('Role', 'Nurse')
->whereNotIn('Status', ['Pending', 'Suspended'])
    ->withAvg('orders', 'rating') // يقوم بحساب متوسط التقييم تلقائياً
    ->orderByDesc('orders_avg_rating') // الترتيب من الأعلى إلى الأقل
    ->take(4) // أخذ أول 4 ممرضين فقط
    ->get();

    $acceptedOrders = Order::where('status', 'Accepted')->get();
    return view('Home', compact('services','nurses'));

}
public function search(Request $request)
{
    $searchQuery = $request->input('search'); // استخدام اسم متغير واضح

    $nurses = \App\Models\User::where('Role', 'Nurse')
        ->where('Username', 'like', "%{$searchQuery}%")->get();

    $services = \App\Models\Service::where('ServiceName', 'like', "%{$searchQuery}%")->get();

    $orders = \App\Models\Order::where('id', 'like', "%{$searchQuery}%")->get();

    return view('search_results', [
        'nurses' => $nurses,
        'services' => $services,
        'orders' => $orders,
        'searchQuery' => $searchQuery // تمرير الاسم الجديد
    ]);
}
}
