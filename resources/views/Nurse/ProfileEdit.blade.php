@extends('layouts.layoutnurse')

@section('contents')
<div class="w-full max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-6 md:p-8 rounded-[2.5rem] shadow-2xl">

        <h2 class="text-2xl font-extrabold text-cyan-950 mb-8 text-center">تعديل ملف الممرض</h2>

        <form action="{{ route('nurse.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
      <div class="flex justify-center">
                <div class="relative group cursor-pointer">
                    <img id="imagePreview" src="{{ auth()->user()->profile?->ProfilePicture ? asset('storage/' . auth()->user()->profile->ProfilePicture) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->Username) }}"
                         class="w-36 h-36 rounded-full object-cover border-4 border-cyan-100 shadow-xl transition group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-white text-xs font-bold">تغيير</div>

                    <input type="file" name="ProfilePicture" id="imageInput" class="absolute inset-0 opacity-0 cursor-pointer">
<span id="statusIndicator"
      onclick="event.stopPropagation(); toggleStatusSlider();"
      class="absolute bottom-0 right-0 h-4 w-4 rounded-full {{ $nurse->Status == 'Available' ? 'bg-green-500' : ($nurse->Status == 'Busy' ? 'bg-red-500' : 'bg-gray-400') }} ring-2 ring-white cursor-pointer z-[10000]">
</span>
<input type="hidden" name="Status" id="statusInput" value="{{ $nurse->Status }}">

<div id="statusSlider" class="hidden absolute left-0 mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-2xl z-[9999] p-2 overflow-hidden transition-all duration-200">
    <h3 class="text-[10px] font-bold text-slate-400 uppercase px-3 py-2">تعديل الحالة</h3>

    <div class="space-y-0.5">
        <button type="button" onclick="setStatus('Available')" class="w-full text-right px-4 py-2 hover:bg-green-50 text-green-700 text-sm font-bold transition-colors flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500"></span> متاح
        </button>
        <button type="button" onclick="setStatus('Busy')" class="w-full text-right px-4 py-2 hover:bg-red-50 text-red-700 text-sm font-bold transition-colors flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-500"></span> مشغول
        </button>
        <button type="button" onclick="setStatus('Offline')" class="w-full text-right px-4 py-2 hover:bg-slate-50 text-slate-600 text-sm font-bold transition-colors flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-slate-400"></span> غير متصل
        </button>
    </div>
</div>>

                </div>




<script>
    function toggleStatusSlider() {
        console.log("تم الضغط!"); // هذا سيظهر في الكونسول إذا كان الزر يعمل
        const slider = document.getElementById('statusSlider');
        if (slider) {
            slider.classList.toggle('hidden');
        } else {
            console.error("عنصر statusSlider غير موجود في الصفحة!");
        }
    }
</script>


<script>
   function setStatus(status) {
        // 1. تحديث الحقل المخفي
        document.getElementById('statusInput').value = status;

        // 2. الحصول على الدائرة
        const indicator = document.getElementById('statusIndicator');

        // 3. إزالة كل كلاسات الألوان المحتملة بوضوح
        indicator.classList.remove('bg-green-500', 'bg-red-500', 'bg-gray-400');

        // 4. إضافة اللون الجديد بناءً على الحالة
        if (status === 'Available') {
            indicator.classList.add('bg-green-500');
        } else if (status === 'Busy') {
            indicator.classList.add('bg-red-500');
        } else {
            indicator.classList.add('bg-gray-400');
        }

        // 5. إغلاق القائمة
        document.getElementById('statusSlider').classList.add('hidden');

        console.log("تم تحديث الدائرة إلى: " + status);
    }
</script>
</div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">اسم المستخدم</label>
                    <input type="text" name="Username" value="{{ auth()->user()->Username }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">التخصص</label>
                    <input type="text" name="Specialization" value="{{ auth()->user()->profile->Specialization ?? '' }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">رقم الهاتف</label>
                    <input type="text" name="PhoneNumber" value="{{ auth()->user()->profile->PhoneNumber ?? '' }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">الجنس</label>
                    <select name="Gender" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                        <option value="Male" {{ auth()->user()->profile?->Gender == 'Male' ? 'selected' : '' }}>ذكر</option>
                        <option value="Female" {{ auth()->user()->profile?->Gender == 'Female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">تاريخ الميلاد</label>
                    <input type="date" name="DateOfBirth" value="{{ auth()->user()->profile->DateOfBirth ?? '' }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
                <div class="bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">المستشفى/المركز</label>
                    <input type="text" name="HospitalOrCenter" value="{{ auth()->user()->profile->HospitalOrCenter ?? '' }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
                <div class="bg-cyan-50/50 p-4 rounded-2xl border border-cyan-100">
    <label class="block text-[10px] font-black text-cyan-800 uppercase mb-1">المدينة</label>
    <input type="text"
           name="City"
           id="cityInput"
           value="{{ auth()->user()->profile->City ?? '' }}"
           class="w-full bg-transparent font-bold text-slate-800 focus:outline-none text-sm">

    <p id="cityWarning" class="text-red-500 text-xs mt-2 hidden font-bold">
        عذراً، الخدمة حالياً متاحة فقط في مدينة المكلا.
    </p>
</div>
                <div class="md:col-span-2 bg-white/50 p-3 rounded-2xl border border-cyan-100">
                    <label class="block text-[10px] text-cyan-800 font-black uppercase mb-1">العنوان</label>
                    <input type="text" name="Address" value="{{ auth()->user()->profile->Address ?? '' }}" class="w-full bg-transparent font-bold text-sm focus:outline-none">
                </div>
            </div>

            <div class="bg-white/50 p-4 rounded-2xl border border-cyan-100">
                <label class="block text-[10px] text-cyan-800 font-black uppercase mb-2">الشهادة الصحية</label>
                @if(auth()->user()->profile?->HealthCertificate)
                    <a href="{{ asset('storage/' . auth()->user()->profile->HealthCertificate) }}" target="_blank" class="text-sm text-cyan-600 underline mb-2 block font-bold">عرض الشهادة المرفوعة</a>
                @else
                    <p class="text-xs text-slate-400 mb-2">لا توجد شهادة مرفوعة حالياً.</p>
                @endif
                <input type="file" name="HealthCertificate" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-cyan-100 file:text-cyan-800 hover:file:bg-cyan-200">
            </div>

            <button type="submit" class="w-full py-3 bg-cyan-900 text-white rounded-2xl font-black shadow-lg hover:bg-cyan-800 transition">حفظ التعديلات</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('imageInput').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('imagePreview').src = URL.createObjectURL(file);
        }
    };
    const cityInput = document.getElementById('cityInput');
    const cityWarning = document.getElementById('cityWarning');

    cityInput.addEventListener('input', function() {
        // التحقق عند الكتابة: إذا لم تكن القيمة هي "المكلا" نظهر التحذير
        if (this.value.trim() !== 'المكلا') {
            cityWarning.classList.remove('hidden');
        } else {
            cityWarning.classList.add('hidden');
        }
    });

    // التحقق عند تحميل الصفحة (في حالة كانت القيمة مخزنة مسبقاً وغير مطابقة)
    if (cityInput.value.trim() !== '' && cityInput.value.trim() !== 'المكلا') {
        cityWarning.classList.remove('hidden');
    }
    // داخل الـ if (التي تظهر التحذير):
document.querySelector('button[type="submit"]').disabled = true;

// داخل الـ else (التي تخفي التحذير):
document.querySelector('button[type="submit"]').disabled = false;
</script>
@endsection
