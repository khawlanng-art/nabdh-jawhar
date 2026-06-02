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
        // أضفنا 'Status' هنا ليتم جلبه من قاعدة البيانات
        ->select('UserID', 'Username', 'Status')
        ->with(['profile:UserID,ProfilePicture,Specialization'])
        ->withAvg('orders', 'rating')
        ->paginate(8);

    return view('Nurse.nurses', compact('nurses'));
}
    public function show($id)
{
    // جلب بيانات الممرض مع علاقة الـ profile
    $nurse = \App\Models\User::with('profile')->findOrFail($id);

    // تمرير بيانات الممرض لصفحة البروفايل
    return view('Nurse.profilenurses', compact('nurse'));
}




}
