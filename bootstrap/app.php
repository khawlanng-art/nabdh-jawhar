<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware) {
    $middleware->validateCsrfTokens(except: [
        '/admin/approve/*',
    ]);

    
})

 ->withExceptions(function (Exceptions $exceptions) {

    // التعامل مع خطأ انتهاء صلاحية الصفحة (CSRF Token)
    $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
        // إذا انتهت الجلسة، أعده لصفحة الدخول مع رسالة تنبيه
        return redirect()->route('login')
            ->with('error', 'انتهت جلسة العمل، يرجى تسجيل الدخول مجدداً.');
    });

})->create();
$exceptions->render(function (AccessDeniedHttpException $e, $request) {
    return response()->view('errors.403', [], 403);
    // أو التوجيه لصفحة معينة
});
