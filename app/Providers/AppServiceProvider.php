<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\User;
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
    {
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
                // تمرير المتغيرين لكل الصفحات
                $view->with([
                    'patient' => $patient,
                    'pendingReviews' => $pendingReviews,
                    'acceptedOrders' => $acceptedOrders
                ]);
            } else {
                // تمرير قيم فارغة في حال عدم تسجيل الدخول لتجنب أخطاء Undefined variable
                $view->with([
                    'patient' => null,
                    'pendingReviews' => collect(),
                    'acceptedOrders' => collect()
                ]);
            }
        });
    }
}
