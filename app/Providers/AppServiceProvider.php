<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot()
    { \Illuminate\Support\Facades\App::setLocale('ar');
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // 1. جلب المريض (بما في ذلك البروفايل)
                $patient = User::with('profile')->find(Auth::id());

                // 2. جلب التقييمات المعلقة
                $pendingReviews = Order::where('UserID', Auth::id())
                                       ->where('status', 'Completed')
                                       ->whereNull('rating')
                                       ->get();
$acceptedOrders = Order::where('UserID', Auth::id())
                                   ->where('status', 'Accepted')
                                   ->get();
$rejectedOrders = Order::where('UserID', Auth::id())
                                   ->where('status', 'Rejected')
                                   ->get();
                // تمرير المتغيرين لكل الصفحات
                $view->with([
                    'patient' => $patient,
                    'pendingReviews' => $pendingReviews,
                    'acceptedOrders' => $acceptedOrders,
                    'rejectedOrders'=> $rejectedOrders
                ]);
            } else {
                // تمرير قيم فارغة في حال عدم تسجيل الدخول لتجنب أخطاء Undefined variable
                $view->with([
                    'patient' => null,
                    'pendingReviews' => collect(),
                    'acceptedOrders' => collect(),
                    'rejectedOrders'=> collect()

                ]);
            }
        });
       View::composer('layouts.layoutnurse', function ($view) {
    if (Auth::check()) {
        $nurseId = Auth::id();

        // جلب الطلبات المعلقة
        $notifications = Order::where('nurse_id', $nurseId)
                              ->where('status', 'Pending')
                              ->get();

        // جلب الطلبات الملغية
       $cancelledNotifications = Order::where('nurse_id', $nurseId)
                               ->where('status', 'Cancelled')
                               ->get();

        // تمرير كلاهما للـ View
        $view->with([
            'notifications' => $notifications,
            'cancelledNotifications' => $cancelledNotifications
        ]);
    } else {
        // تمرير مصفوفات فارغة لتجنب أخطاء الـ Blade إذا لم يسجل الدخول
        $view->with([
            'notifications' => collect(),
            'cancelledNotifications' => collect()
        ]);
    }
});
if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
    }
}
