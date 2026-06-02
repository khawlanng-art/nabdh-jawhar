@extends('layouts.auth')

@section('title', 'انضمي إلينا كممرضة')

@section('content')



<div class="min-h-screen flex items-center bg-[#b8fff980] justify-center p-6 font-tajawal relative overflow-x-hidden" dir="rtl"  >

  <div class="absolute top-6  right-6" >



    <a href="{{ url('/SinUp') }}" class="p-2 rounded-full hover:bg-cyan-100/30 transition-all active:scale-90 group inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7 text-gray-600 group-hover:text-[#00bcd4]">

            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>
    </a>
</div>

    <div class="w-full max-w-md bg-transparent my-10" >

        <div class="flex flex-col items-center mb-8">
          <div >
      <div class="text-teal-400 w-32 h-32 mb-4">
            @include('partials.logo-svg')
        </div>
    </div>
             <h1 class="text-4xl font-extrabold font-Tajawal leading-none"
                style="color: #0e7490; text-shadow: 1px 1px 0px #ffffff, 2px 2px 0px #a3c9d1, 3px 3px 0px #8eb4bd, 5px 5px 10px rgba(0,0,0,0.2);">
                نبض جوار
            </h1>
            <p class="mt-4 text-m font-bold font-Tajawal text-[#00336d]">
           "نبض جوار: معاً نحو رعاية أفضل، ابدأ رحلتكِ معنا الان"
            </p>
        </div>


        @if ($errors->any())
    <div id="errorMessage" class="bg-red-100 text-red-600 p-4 rounded-xl mb-4 text-right transition-opacity duration-500">
        <ul class="list-disc pr-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('register.nurse.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-right  " autocomplete="off"  >
            @csrf

            <div class="space-y-4" >
                <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">المعلومات الشخصية</h2>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">الاسم الكامل</label>
                    <input type="text" name="Username" value="{{ old('Username') }}" placeholder="أدخل اسمك الكامل" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
                </div>

                <div>
    <label class="block text-sm font-bold text-gray-700 mb-2">رقم الجوال</label>
    <div class="flex w-full">
        <input type="tel"
               name="PhoneNumber"
               value="{{ old('PhoneNumber') }}"
               placeholder="7xxxxxxxx"
               pattern="[7][0-9]{8}"
               maxlength="9"
               class="w-full px-4 py-3 border border-gray-300 rounded-r-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm border-l-0"
               required>

        <span class="flex items-center px-4 bg-gray-100 border border-gray-300 rounded-l-xl text-gray-600 font-bold">
            967+
        </span>
    </div>
    <div class="flex items-center gap-2 mt-2 p-3 bg-red-50 border border-red-200 rounded-lg animate-in fade-in duration-500">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <p class="text-xs font-medium text-red-600">
        يجب أن يبدأ الرقم بـ 7 ويكون مكوناً من 9 أرقام (بدون مفتاح الدولة)
    </p>
</div>
</div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تاريخ الميلاد</label>
                        <input type="date" name="DateOfBirth" value="{{ old('DateOfBirth') }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm text-gray-500 text-right" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">الجنس</label>
                        <select name="Gender" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm text-gray-500" required>
                            <option value="" disabled selected>اختر...</option>
                            <option value="Male" {{ old('Gender') == 'Male' ? 'selected' : '' }}>ذكر</option>
                            <option value="Female" {{ old('Gender') == 'Female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">معلومات الحساب</h2>
     <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm text-gray-600" required autocomplete="off">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                        <input type="password" name="password" placeholder="********" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required autocomplete="new-password">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" placeholder="********" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">المعلومات المهنية</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">جهة العمل</label>
                        <input type="text" name="HospitalOrCenter" value="{{ old('HospitalOrCenter') }}" placeholder="اسم المستشفى" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">التخصص</label>
                        <input type="text" name="Specialization" value="{{ old('Specialization') }}" placeholder="مثلاً: عناية مركزة" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">العنوان السكني</h2>
<textarea name="Address" placeholder="العنوان بالتفصيل..." rows="2"
        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm">{{ old('Address', $nurse->profile->Address ?? '') }}</textarea>
                    <div class="w-full">
    <label class="block text-sm font-bold text-gray-700 mb-2">المدينة</label>
    <input type="text"
           name="city"
             value="{{ old('City') }}"
           id="cityInput"
           placeholder="أدخل مدينتك"
           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm"
           required>

    <p id="cityWarning" class="text-red-500 text-xs mt-2 hidden font-bold">
        عذراً، الخدمة حالياً متاحة فقط في مدينة المكلا.
    </p>
</div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">المستندات المطلوبة</h2>
                <div class="space-y-3">
                    @foreach([
                        'ProfilePicture' => 'صورة شخصية',

                        'HealthCertificate' => 'شهادة التخرج'

                    ] as $name => $label)
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">{{ $label }}</label>
                        <div class="flex items-center border border-gray-300 rounded-xl bg-white overflow-hidden shadow-sm h-12">
                            <label for="file_{{ $name }}" class="bg-gray-100 px-4 h-full flex items-center text-sm border-l border-gray-300 cursor-pointer hover:bg-gray-200 transition font-bold text-gray-700">رفع</label>

                            <input type="file" name="{{ $name }}" id="file_{{ $name }}" class="hidden file-input" accept=".jpg,.png,.pdf" required>
                            <span id="display_{{ $name }}" class="text-gray-400 text-xs px-3 italic flex-1 truncate">...اختر ملف</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
<div class="flex items-center gap-2 mt-4">
    <input type="checkbox" id="privacyCheckbox" class="w-5 h-5 accent-[#00bcd4] rounded cursor-pointer">

<div ><label for="privacyCheckbox" class="text-sm text-gray-600 font-bold">
        أوافق على
    <button type="button" onclick="togglePrivacy()" class="text-[#00bcd4] underline font-bold text-sm">
        قراءة سياسة الخصوصية والشروط والأحكام
    </button>
     </label>
</div>

</div>
           <button type="submit"
        id="submitBtn"
        disabled
        class="w-full bg-gray-300 text-white py-4 rounded-2xl font-black text-xl transition-all cursor-not-allowed">
    تأكيد إنشاء الحساب
</button>
        </form>

        <div class="mt-8 mb-12 text-center text-gray-500">
            لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-[#00bcd4] font-bold underline">تسجيل الدخول</a>
        </div>
    </div>
    </div>
  </div>


<!-- النافذة المنبثقة (Modal) -->
<div id="privacyModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-lg w-full max-h-[80vh] overflow-y-auto shadow-2xl">
        <h2 class="text-xl font-black text-cyan-800 mb-4 border-b pb-2">سياسة الخصوصية والشروط</h2>

        <div class="text-sm text-gray-600 space-y-4 leading-relaxed">
            <p><strong>سياسة الخصوصية:</strong> نحن نلتزم بحماية بياناتك الشخصية واستخدامها فقط لغرض تقديم الخدمة...</p>
            <p><strong>الشروط والأحكام:</strong>
                <ul class="list-disc pr-4">
                    <li>الالتزام المهني بالأخلاقيات.</li>
                    <li>الحفاظ على سرية معلومات المرضى.</li>
                    <li>المسؤولية عن دقة البيانات المقدمة.</li>
                </ul>
            </p>
        </div>

        <button type="button" onclick="togglePrivacy()" class="mt-6 w-full bg-cyan-500 text-white py-3 rounded-xl font-bold hover:bg-cyan-600">
            إغلاق
        </button>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const errorDiv = document.getElementById('errorMessage');

        if (errorDiv) {
            // الانتظار لمدة 5000 ميلي ثانية (5 ثوانٍ)
            setTimeout(() => {
                // جعل العنصر شفافاً تدريجياً
                errorDiv.style.opacity = '0';

                // إزالته من مساحة العرض بعد اكتمال التأثير
                setTimeout(() => {
                    errorDiv.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
    function togglePrivacy() {
    const modal = document.getElementById('privacyModal');
    modal.classList.toggle('hidden');
}
const checkbox = document.getElementById('privacyCheckbox');
    const submitBtn = document.getElementById('submitBtn');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            submitBtn.classList.add('bg-[#00bcd4]', 'shadow-lg', 'hover:opacity-95', 'active:scale-95');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-[#00bcd4]', 'shadow-lg', 'hover:opacity-95', 'active:scale-95');
        }
    });
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const fieldName = this.id.replace('file_', '');
            const displaySpan = document.getElementById('display_' + fieldName);
            const fileName = e.target.files[0] ? e.target.files[0].name : "...اختر ملف";

            displaySpan.textContent = fileName;
            if (e.target.files[0]) {
                displaySpan.classList.remove('text-gray-400', 'italic');
                displaySpan.classList.add('text-[#00bcd4]', 'font-bold');
            }
        });
    });
    const cityInput = document.getElementById('cityInput');
    const warning = document.getElementById('cityWarning');

    cityInput.addEventListener('blur', function() {
        // نقوم بتحويل النص إلى lowercase ونحذف الفراغات للتأكد من المقارنة بدقة
        const cityValue = this.value.trim();

        if (cityValue !== "" && cityValue !== "المكلا") {
            warning.classList.remove('hidden'); // إظهار الرسالة
        } else {
            warning.classList.add('hidden'); // إخفاء الرسالة إذا كانت "المكلا" أو فارغة
        }
    });

</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap');
    .font-tajawal { font-family: 'Tajawal', sans-serif; }
    .truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
</style>

@endsection
