<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('Admin.services', compact('services'));
    }
    public function indexServices()
    {
        $services = \App\Models\Service::where('IsActive', 1)->latest()->get();
        return view('Services.Services', compact('services'));
    }
public function show($id)
{
    $service = \App\Models\Service::find($id); // استخدمي find بدلاً من findOrFail مؤقتاً

    if (!$service) {
        return "الخدمة غير موجودة!"; // إذا ظهرت هذه الرسالة، فالمشكلة في الـ ID
    }

    return view('Services.Servicedetails', compact('service'));
}
public function destroy($id)
{
    $service = \App\Models\Service::findOrFail($id);

    if ($service->IconURL) {
        Storage::disk('public')->delete($service->IconURL);
    }

    $service->delete();

    return back()->with('success', 'تم حذف الخدمة بنجاح');
}
public function store(Request $request)
{

    $data = $request->only(['ServiceName', 'Description', 'BasePrice', 'CategoryName']);
    $data['IsActive'] = true;


    if ($request->hasFile('ServiceImage')) {

        $path = $request->file('ServiceImage')->store('services', 'public');
        $data['IconURL'] = $path;
    } else {

        $data['IconURL'] = $request->ServiceIcon;
    }

    \App\Models\Service::create($data);

    return back()->with('success', 'تم الحفظ بنجاح');
}

   public function update(Request $request, $id)
{

    $service = \App\Models\Service::findOrFail($id);


    $data = $request->only(['ServiceName', 'Description', 'BasePrice', 'CategoryName']);
    $data['IsActive'] = $request->has('IsActive') ? $request->IsActive : $service->IsActive;


    if ($request->hasFile('ServiceImage')) {


        if ($service->IconURL && Storage::disk('public')->exists($service->IconURL)) {
            Storage::disk('public')->delete($service->IconURL);
        }


        $path = $request->file('ServiceImage')->store('services', 'public');
        $data['IconURL'] = $path;

    } else {
        $data['IconURL'] = $request->filled('ServiceIcon') ? $request->ServiceIcon : $service->IconURL;
    }


    $service->update($data);

    return back()->with('success', 'تم تحديث بيانات الخدمة بنجاح');
}
}
