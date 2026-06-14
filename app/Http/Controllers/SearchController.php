<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
{
    $adminQuery = $request->get('q');

    // جرب البحث عن جزء بسيط من الاسم
    $users = User::where('Username', 'LIKE', '%' . $adminQuery . '%')->get();

    // أضف هذا السطر لرؤية ما يحدث في الـ Log
    Log::info('البحث عن: ' . $adminQuery . ' النتائج: ' . $users->count());

    return response()->json([
        'users' => $users,
        'services' => Service::where('ServiceName', 'LIKE', '%' . $adminQuery . '%')->get()
    ]);
}
}
