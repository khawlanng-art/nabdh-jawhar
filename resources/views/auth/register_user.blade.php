@extends('layouts.auth')

@section('title', 'إنشاء حساب مستخدم')

@section('content')
<div class="min-h-screen w-full bg-[#b8fff980] flex flex-col items-center p-6 relative overflow-y-auto font-tajawal" dir="rtl">

  <div class="absolute top-6 right-6">

    <a href="{{ url('/SinUp') }}" class="p-2 rounded-full hover:bg-cyan-100/30 transition-all active:scale-90 group inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7 text-gray-600 group-hover:text-[#00bcd4]">

            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>
    </a>
</div>
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
            "نحن بجوارك دائماً،  سجل حسابك الآن"
            </p>
    <form action="{{ route('register.user.post') }}" method="POST" class="w-full max-w-md space-y-6 text-right " autocomplete="off">
        @csrf
@if ($errors->any())
    <div id="errorMessage" class="bg-red-100 text-red-600 p-4 rounded-xl mb-4 text-right transition-opacity duration-500">
        <ul class="list-disc pr-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="space-y-4">
            <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">المعلومات الشخصية</h2>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">الاسم الكامل</label>
                <input type="text" name="Username" value="{{ old('Username') }}" placeholder="الاسم الكامل"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
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
                    <input type="date" name="DateOfBirth" value="{{ old('DateOfBirth') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">الجنس</label>
                    <select name="Gender" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
                        <option value="" disabled selected>اختر...</option>
                        <option value="Male" {{ old('Gender') == 'Male' ? 'selected' : '' }}>ذكر</option>
                        <option value="Female" {{ old('Gender') == 'Female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>
            </div>

            <div>
               <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">العنوان السكني</h2>
<textarea name="Address" placeholder="العنوان بالتفصيل..." rows="2"
        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm">{{ old('Address') }}</textarea>


            </div>
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

        <div class="space-y-4 pt-4">
            <h2 class="text-lg font-bold text-[#00bcd4] border-b border-gray-200 pb-1">معلومات الأمان</h2>

           <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm text-gray-600" required autocomplete="off">
                </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                    <input type="password" name="password" placeholder="********" autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
               @error('password')
    <span class="text-red-500 text-sm mt-1 block pr-2">
        {{ $message == 'The password field must be at least 8 characters.' ? 'يجب أن تكون كلمة المرور 8 خانات على الأقل' : $message }}
    </span>
@enderror
                    </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" placeholder="********"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#00bcd4] outline-none transition bg-white shadow-sm" required>
@error('password')
        <span class="text-red-500 text-sm block pr-2">يجب أن تكون مطابقه</span>
    @enderror
                    </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#00bcd4] text-white py-4 rounded-2xl font-black text-xl shadow-lg shadow-cyan-200 hover:opacity-95 transition transform active:scale-95 mt-8">
            تأكيد إنشاء الحساب
        </button>
    </form>
<div class="mt-8 mb-12 text-center text-gray-500">
            لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-[#00bcd4] font-bold underline">تسجيل الدخول</a>
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
function getLocation() {
    const addressInput = document.getElementById('address_field');
    if (navigator.geolocation) {
        addressInput.placeholder = "جاري الاتصال بالأقمار الصناعية...";
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}&accept-language=ar`)
                .then(response => response.json())
                .then(data => {
                    const addr = data.address;
                    let displayAddr = "";
                    if(addr.suburb) displayAddr += addr.suburb + ", ";
                    if(addr.city || addr.town) displayAddr += (addr.city || addr.town) + ", ";
                    if(addr.state) displayAddr += addr.state;

                    addressInput.value = (displayAddr || data.display_name) + " - (يرجى كتابة اسم الحي والشارع هنا)";
                    addressInput.focus();
                })
                .catch(err => {
                    addressInput.value = `تم تحديد موقعك (إحداثيات: ${lat}, ${lon})`;
                });
        }, function(error) {
            alert("فشل تحديد الموقع، تأكد من تفعيل الـ GPS");
            addressInput.placeholder = "اكتب عنوانك بالتفصيل هنا...";
        });
    }
}const cityInput = document.getElementById('cityInput');
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
</style>
@endsection
