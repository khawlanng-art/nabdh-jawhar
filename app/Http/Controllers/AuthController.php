<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Hash;
use Closure;
class AuthController extends Controller
{public function showLogin() {
return view('auth.login');
}


public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
$userExists = User::where('email', $request->email)->exists();

    if (!$userExists) {
        return back()->withErrors(['email' => 'هذا البريد الإلكتروني غير مسجل لدينا.']);
    }
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();


        if ($user->Role === 'Nurse' && ($user->Status === 'Pending' || $user->Status === 'Suspended')) {
    Auth::logout();

    $message = ($user->Status === 'Suspended')
        ? 'حسابك تم إيقافه من قبل الإدارة.'
        : 'حسابك لا يزال قيد المراجعة لدى الإدارة.';

    return back()->withErrors(['email' => $message]);
}


        if ($user->Role === 'Nurse') {
             return redirect()->route('Nurse.dashboard')->with('success', 'مرحباً بك مجدداً!');
        }

        return $this->redirectBasedOnRole($user);
    }

    return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.']);
}


public static function redirectBasedOnRole( $user)
{
    return match($user->Role) {
        'Admin'   => redirect()->route('admin.dashboard'),
        'Nurse'   => redirect()->route('Nurse.dashboard'),
        'Patient' => redirect()->route('Home'),

        default   => redirect()->route('login'),
    };
}

   public function logout(Request $request)
{
    Auth::logout();
    $request->session()->flush();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

  return redirect()->route('guest.index');
}


public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();


        return $this->redirectBasedOnRole($user);
    }

    return back()->withErrors(['email' => 'فشل التحديث']);
}
    public function registerUser(Request $request) {
       $request->validate([
      'Username' => 'required|string|max:255|unique:users,Username',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
        'City' => ['required', function ($attribute, $value, $fail) {
            if (trim($value) !== 'المكلا') {
                $fail('عذراً، الخدمة حالياً متاحة فقط في مدينة المكلا.');
            }
        }],
    ], [
        // رسائل الخطأ بالعربي
        'City.required' => 'حقل المدينة مطلوب.',
        'Username.unique' => 'عذراً، اسم المستخدم هذا موجود بالفعل، يرجى اختيار اسم آخر.',
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'password.required' => 'كلمة المرور مطلوبة.',
    ]);

        $user = User::create([
            'Username' => $request->Username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Role' => 'Patient',
            'Status' => 'Active',
        ]);


        ProfileUser::create([
            'UserID' => $user->UserID,
            'PhoneNumber' => $request->PhoneNumber,
            'Gender' => $request->Gender,
            'DateOfBirth' => $request->DateOfBirth,
            'Address' => $request->Address,
            'City'           => $request->City,
        ]);

        Auth::login($user);
        return redirect('/Home');
    }

    public function registerNurse(Request $request) {
        $request->validate([
            'Username'          => 'required|string|max:255',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|confirmed|min:8',
            'PhoneNumber'       => 'required',
 'City' => ['required', function ($attribute, $value, $fail) {
            if (trim($value) !== 'المكلا') {
                $fail('عذراً، الخدمة حالياً متاحة فقط في مدينة المكلا.');
            }
        }],
   'ProfilePicture' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    'HealthCertificate' => 'required|file|mimes:pdf,jpeg,png|max:5120',
], [
    // رسائل الخطأ بالعربي
    'ProfilePicture.required' => 'يرجى اختيار صورة شخصية.',
    'ProfilePicture.image'    => 'يجب أن يكون الملف المرفوع صورة.',
    'ProfilePicture.mimes'    => 'صيغة الصورة يجب أن تكون (jpeg, png, jpg, webp).',
    'ProfilePicture.max'      => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',

    'HealthCertificate.required' => 'شهادة التخرج مطلوبة.',
    'HealthCertificate.mimes'    => 'صيغة الشهادة يجب أن تكون (pdf, jpeg, png).',
    'HealthCertificate.max'      => 'حجم الملف يجب ألا يتجاوز 5 ميجابايت.',
        // رسائل الخطأ بالعربي
        'City.required' => 'حقل المدينة مطلوب.',
        'Username.unique' => 'عذراً، اسم المستخدم هذا موجود بالفعل، يرجى اختيار اسم آخر.',
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'password.required' => 'كلمة المرور مطلوبة.',
    ]);

        $certPath    = $request->hasFile('HealthCertificate') ? $request->file('HealthCertificate')->store('docs', 'public') : null;
        $profilePath = $request->hasFile('ProfilePicture')    ? $request->file('ProfilePicture')->store('profiles', 'public') : null;
if ($request->hasFile('ProfilePicture')) {
    $imageFile = $request->file('ProfilePicture');
    $filename = 'profile_' . time() . '.jpg';
    $path = public_path('storage/profiles/' . $filename);

    // 1. التأكد من أن المجلد موجود
    if (!file_exists(public_path('storage/profiles'))) {
        mkdir(public_path('storage/profiles'), 0755, true);
    }

    // 2. قراءة الصورة الأصلية (بدون الحاجة لمكتبة خارجية)
    $imagePath = $imageFile->getRealPath();
    $info = getimagesize($imagePath);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg': $src = imagecreatefromjpeg($imagePath); break;
        case 'image/png':  $src = imagecreatefrompng($imagePath); break;
        case 'image/webp': $src = imagecreatefromwebp($imagePath); break;
        default: $src = imagecreatefromjpeg($imagePath);
    }

    // 3. تصغير الصورة إلى أبعاد 400x400
    $tmp = imagecreatetruecolor(400, 400);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, 400, 400, $info[0], $info[1]);

    // 4. حفظ الصورة بجودة 60% (وهذا هو سر الضغط)
    imagejpeg($tmp, $path, 60);

    // 5. تنظيف الذاكرة
    imagedestroy($src);
    imagedestroy($tmp);

    $profilePath = 'profiles/' . $filename;
}

        $user = User::create([
            'Username' => $request->Username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'Role'     => 'Nurse',
            'Status'   => 'Pending',
        ]);

        ProfileUser::create([
            'UserID'            => $user->UserID,
            'PhoneNumber'       => $request->PhoneNumber,
            'Gender'            => $request->Gender,
            'DateOfBirth'       => $request->DateOfBirth,
            'HospitalOrCenter'  => $request->HospitalOrCenter,
            'Specialization'    => $request->Specialization,
            'Address'           => $request->Address,
            'City'              => $request->City,
            'HealthCertificate' => $certPath,
            'ProfilePicture'    => $profilePath,

        ]);

        return redirect('/login')->with('success', 'تم تقديم طلبك بنجاح. سيقوم المسؤول بمراجعة بياناتك وتفعيل حسابك قريباً.');
    }

}
