<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileUser;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
class DashboardController extends Controller
{
 public function store(Request $request)
{

    $request->validate([
        'ServiceName'  => 'required|string|max:255',
        'BasePrice'    => 'required|numeric',
        'CategoryName' => 'nullable|string',
        'ServiceImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {

        $data = [
            'ServiceName'  => $request->ServiceName,
            'Description'  => $request->Description,
            'BasePrice'    => $request->BasePrice,
            'CategoryName' => $request->CategoryName,
            'IsActive'     => 1,
            'CreatedAt'    => now(),
        ];


        if ($request->hasFile('ServiceImage')) {

            $path = $request->file('ServiceImage')->store('services', 'public');
            $data['IconURL'] = $path;
        }


       Service::create($data);

        return back()->with('success', 'تمت إضافة الخدمة الطبية بنجاح!');

    } catch (\Exception $e) {

        return back()->withErrors(['error' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()]);
    }
}

   public function index()
{
$nurses = User::where('Role', 'Nurse') // جلب الممرضين فقط
              ->withAvg('orders', 'rating') // حساب متوسط عمود الـ rating لكل ممرض
              ->get();
    $pendingNurses = User::where('Role', 'Nurse')
                         ->where('Status', 'Pending')
                         ->get();

    $activeNurses = User::where('Role', 'Nurse')
                        ->where('Status', '!=', 'Pending')
                        ->get();

    $totalPatients = User::where('Role', 'Patient')->count();
    $allPatients = User::where('Role', 'Patient')->get();
    $services = Service::all();
$totalServices = $services->count();

    return view('admin.dashboard', compact('pendingNurses', 'activeNurses', 'totalPatients', 'allPatients','services','totalServices','nurses'));
}


  public function approveNurse(int $id)
    {
      $nurse = User::findOrFail($id);
    $nurse->Status = 'Available';
    $nurse->save();
        return redirect()->back()->with('success', 'تم تفعيل حساب الممرض/ة ' . $nurse->Username . ' بنجاح.');
    }

public function showNurse(int $id)
{
    $nurse = User::findOrFail($id);

    return view('Admin.nurse-details', compact('nurse'));
}

public function updateNurse(Request $request,int $id) {

    $request->validate([
        'Username'         => 'required|string|max:255',
        'PhoneNumber'      => 'required',
        'Gender'           => 'required|in:Male,Female',
        'DateOfBirth'      => 'nullable|date',
        'Specialization'   => 'required',
        'Address'          => 'required|string',
        'HospitalOrCenter' => 'required|string',
        'ProfilePicture'   => 'nullable|image|max:2048',

        'HealthCertificate'=> 'nullable|image|max:2048',

    ]);

    $nurse = User::findOrFail($id);
    $nurse->update(['Username' => $request->Username]);

    if ($nurse->profile) {

        $updateData = $request->only(['PhoneNumber','Gender','DateOfBirth', 'Specialization', 'HospitalOrCenter', 'Address']);

        $images = ['ProfilePicture', 'HealthCertificate'];
        foreach ($images as $img) {
            if ($request->hasFile($img)) {

                if ($nurse->profile->$img && Storage::disk('public')->exists($nurse->profile->$img)) {
                    Storage::disk('public')->delete($nurse->profile->$img);
                }

                $updateData[$img] = $request->file($img)->store('nurse_docs', 'public');
            }
        }


        $nurse->profile->update($updateData);
    }

    return back()->with('success', 'تم تحديث كافة البيانات بنجاح');
}
public function deleteNurse(int $id) {
    $nurse = User::findOrFail($id);


    if($nurse->profile) {

        $nurse->profile->delete();
    }

    $nurse->delete();

    return back()->with('success', 'تم حذف حساب الممرض والبيانات المرتبطة به بنجاح');
}
public function deletePatient(int $id) {
    $patient = User::findOrFail($id);


    if($patient->profile) {

        $patient->profile->delete();
    }

    $patient->delete();

    return back()->with('success', 'تم حذف حساب المريض والبيانات المرتبطة به بنجاح');
}
public function updatePatient(Request $request,int $id)
{

    $validatedData = $request->validate([
        'Username'    => 'required|string|max:255',
        'PhoneNumber' => 'nullable|string',
        'Gender'      => 'required|in:Male,Female',
        'DateOfBirth' => 'nullable|date',
        'Address'     => 'nullable|string|max:500',
    ]);


    $patient = User::findOrFail($id);
    $patient->update([
        'Username'    => $request->Username,


    ]);


    if ($patient->profile) {
        $patient->profile->update([
            'DateOfBirth' => $request->DateOfBirth,
            'Address'     => $request->Address,
            'PhoneNumber' => $request->PhoneNumber,
            'Gender'      => $request->Gender,
        ]);
    } else {

        $patient->profile()->create([
            'DateOfBirth' => $request->DateOfBirth,
            'Address'     => $request->Address,
        ]);
    }

    return redirect()->back()->with('success', 'تم تحديث بيانات المريض بنجاح');
}



public function reject(int $id)
{
    $nurse = User::findOrFail($id);
    $nurse->delete();

    return redirect()->back()->with('success', 'تم رفض هذا الحساب .');
}

public function suspendNurse($id)
{

   $nurse = User::findOrFail($id);
    $nurse->Status = 'Suspended';
    $nurse->save();
    return back()->with('success', 'تم إيقاف المستخدم بنجاح.');
}



}
