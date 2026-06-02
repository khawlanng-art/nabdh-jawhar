<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image; // تأكدي من تثبيت المكتبة

class PatientController extends Controller
{
    // دالة عرض صفحة التعديل
    public function edit()
    {
        $user = Auth::user();
        return view('Patient.profile-edit', compact('user'));
    }

public function update(Request $request)
{
    // 1. التحقق من البيانات الأساسية فقط أولاً
    $request->validate([
        'Username'    => 'required|string',
        'PhoneNumber' => 'required',
    ]);

    $patient = User::find(Auth::id());
    if (!$patient) return back()->withErrors('المستخدم غير مسجل');

    // 2. تحديث بيانات المستخدم والبروفايل (بدون صورة حالياً للتجربة)
    $patient->update(['Username' => $request->Username]);

    $profile = $patient->profile ?? new ProfileUser(['UserID' => Auth::id()]);
    $profile->fill($request->only(['DateOfBirth', 'Address', 'PhoneNumber', 'Gender']));
    $profile->save();

    // 3. معالجة الصورة في خطوة منفصلة وآمنة
    if ($request->hasFile('ProfilePicture')) {
        // استخدمي التخزين المباشر للارافيل (أكثر استقراراً من GD)
        $file = $request->file('ProfilePicture');
        $filename = 'profile_' . Auth::id() . '.jpg';

        // الحفظ في storage مباشرة
        $file->storeAs('profiles', $filename, 'public');

        $profile->ProfilePicture = 'profiles/' . $filename;
        $profile->save();
    }

    return redirect()->route('Home')->with('success', 'تم الحفظ بنجاح!');
}
}
