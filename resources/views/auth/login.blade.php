@extends('layouts.auth')

@section('content')
<div class="flex flex-col min-h-screen w-full text-center items-center justify-center bg-[#b8fff980]">
  @if(session('success'))
    <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-sm transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif

    <div class="absolute top-6 right-6">
        <a href="{{ url('/Home') }}" class="p-2 rounded-full hover:bg-cyan-100/30 transition-all active:scale-90 group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7 text-gray-600 group-hover:text-[#00bcd4]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>

     <div class="flex flex-col items-center w-full max-w-lg mt-5">

        <div class="text-teal-400 w-32 h-32 mb-4">
            @include('partials.logo-svg')
        </div>

       <div class="flex flex-col items-center text-center space-y-2">
            <h1 class="text-4xl font-extrabold font-Tajawal leading-none "
                style="color: #0e7490; text-shadow: 1px 1px 0px #ffffff, 2px 2px 0px #a3c9d1, 3px 3px 0px #8eb4bd, 5px 5px 10px rgba(0,0,0,0.2);">
                نبض جوار
            </h1>





<div id="error-container">
    @if ($errors->any())
        <div class="w-full p-3 mb-4 text-xs text-red-500 bg-red-50 rounded-xl text-right animate-fade-in">
            <ul class="list-none">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
        <div id="selection-screen" class="w-full ">
             <p class="mt-4 text-m font-bold font-Tajawal text-[#00336d]">
   "نحن بانتظارك، سجـــل دخولك الآن"
    </p>
            <div class="relative w-full aspect-[4/2] mb-6 space-y-2">
              <svg viewBox="0 0 400 300"  fill="none" xmlns="http://www.w3.org/2000/svg" class="w-90 h-60 drop-shadow-sm">
    <path d="M200 280 V160 C200 120 160 100 80 100" stroke="#67E8F9" stroke-width="6" stroke-linecap="round"/>
    <path d="M200 280 V160 C200 120 240 100 320 100" stroke="#67E8F9" stroke-width="6" stroke-linecap="round"/>

    <circle cx="200" cy="85" r="14" fill="#EC4899" />

    <g transform="translate(45, 100)">
        <circle cx="35" cy="25" r="22" fill="#A5F3FC"/> <rect y="60" width="70" height="85" rx="12" fill="white"/>
        <rect x="20" y="75" width="30" height="30" rx="4" fill="#BAE6FD"/> <path d="M30 90 H 40 M 35 85 V 95" stroke="#06B6D4" stroke-width="3" stroke-linecap="round"/> <rect x="20" y="155" width="12" height="25" rx="6" fill="#E2E8F0"/>
        <rect x="38" y="155" width="12" height="25" rx="6" fill="#E2E8F0"/>
    </g>

    <g transform="translate(285, 100)">
        <circle cx="35" cy="25" r="22" fill="#0891B2"/> <rect y="60" width="70" height="75" rx="12" fill="#BAE6FD"/>
        <rect x="20" y="145" width="12" height="20" rx="6" fill="#CBD5E1" opacity="0.6"/>
        <rect x="38" y="145" width="12" height="20" rx="6" fill="#CBD5E1" opacity="0.6"/>
    </g>
</svg>
            </div>

            <div class="w-full max-w-xs ">

                <button onclick="openLoginForm()" class="w-full text-lg bg-[#00bcd4] text-white py-2.5 rounded-xl font-bold text-base shadow-md hover:shadow-lg active:scale-95 transition-all">
                    تسجيل الدخول
                </button>
                 <p class="text-gray-500 mt-4 text-sm">
    ليس لديك  حساب؟
    <a href="{{ route('SinUp.sinup') }}" class="text-cyan-600 font-semibold hover:underline"> انشاء حساب جديد</a>
</p>
            </div>
        </div>


       <div id="form-screen" class="hidden w-full max-w-sm px-6 animate-fade-in">
            <form action="{{ route('login.post') }}" method="POST" autocomplete="off" class="space-y-4">
                @csrf
                <input type="password" name="f_pass" style="display:none">

                <input type="email" name="email" id="email_field" placeholder="البريد الإلكتروني" required
                    class="w-full p-3 rounded-xl border border-teal-50 shadow-sm outline-none focus:border-[#00bcd4] text-right text-sm">

                <input type="password" name="password" id="pass_field" placeholder="كلمة المرور" required
                    class="w-full p-3 rounded-xl border border-teal-50 shadow-sm outline-none focus:border-[#00bcd4] text-right text-sm">


                <button type="submit" class="w-full bg-[#00bcd4] text-white py-2.5 rounded-xl font-bold text-base shadow-md">
                    دخول
                </button>

                <button type="button" onclick="toggleReset(true)" class="text-slate-400 text-m underline mt-4">
                    نسيت كلمة المرور؟
                </button>
            </form>

            <form id="reset-form" class="hidden space-y-4 mt-4" action="{{ route('password.update.custom') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="email" name="email" id="reset_email" placeholder="البريد الإلكتروني" required
                    class="w-full p-3 rounded-xl border border-teal-50 text-right shadow-sm outline-none focus:border-teal-400 text-sm">

                <input type="password" name="password" placeholder="كلمة المرور الجديدة" required
                    class="w-full p-3 rounded-xl border border-teal-50 text-right shadow-sm outline-none focus:border-teal-400 text-sm">

                <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" required
                    class="w-full p-3 rounded-xl border border-teal-50 text-right shadow-sm outline-none focus:border-teal-400 text-sm">

                <button type="submit" class="w-full py-2.5 rounded-xl bg-teal-600 text-white font-bold text-base shadow-md active:scale-95 transition-all">
                    تحديث كلمة المرور
                </button>

                <button type="button" onclick="toggleReset(false)" class="text-slate-400 text-xs block w-full mt-2">إلغاء</button>
            </form>
        </div>
    </div>

    <div class="h-10"></div>
</div>

<script>
    let currentView = 'selection';
    let isResetMode = false;

   function openLoginForm() {
    currentView = 'form';

    // إخفاء شاشة الاختيار وإظهار الفورم
    document.getElementById('selection-screen').classList.add('hidden');
    document.getElementById('form-screen').classList.remove('hidden');

    // مسح مدخلات المستخدم
    clearAllInputs();

    // إخفاء حاوية الأخطاء القديمة (إن وجدت) لكي لا تظهر فور الدخول
    const errorContainer = document.getElementById('error-container');
    if (errorContainer) {
        errorContainer.style.display = 'none';
    }
}
    function handleBack() {
        if (isResetMode) {
            toggleReset(false);
        } else if (currentView === 'form') {
            document.getElementById('form-screen').classList.add('hidden');
            document.getElementById('selection-screen').classList.remove('hidden');
            currentView = 'selection';
        } else {
            window.history.back();
        }
    }

    function toggleReset(show) {
        isResetMode = show;
        document.querySelector('#form-screen form').classList.toggle('hidden', show);
        document.getElementById('reset-form').classList.toggle('hidden', !show);
    }

    function clearAllInputs() {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            if(input.type !== 'hidden') {
                input.value = '';
                input.setAttribute('readonly', 'readonly');
                setTimeout(() => input.removeAttribute('readonly'), 100);
            }
        });
    }

    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        window.history.go(1);
    };
window.addEventListener('DOMContentLoaded', (event) => {
        const successDiv = document.getElementById('successMessage');

        if (successDiv) {
            // انتظار 5 ثوانٍ
            setTimeout(() => {
                // جعلها تتلاشى
                successDiv.style.opacity = '0';

                // إزالتها بعد اكتمال تأثير التلاشي
                setTimeout(() => {
                    successDiv.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
</script>

<style>
    .animate-fade-in { animation: fadeIn 0.3s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    body { font-family: 'Tajawal', sans-serif; }
</style>
@endsection
