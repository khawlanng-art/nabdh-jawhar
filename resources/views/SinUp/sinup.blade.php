@extends('layouts.auth')

@section('title', 'إنشاء حساب')

@section('content')
<div class="min-h-screen w-full flex flex-col items-center py-5 px-4 bg-[#b8fff980]">

    <div class="absolute top-6 right-6">
        <a href="{{ url('/login') }}" class="p-2 rounded-full hover:bg-cyan-100/30 transition-all active:scale-90 group inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-7 h-7 text-gray-600 group-hover:text-[#00bcd4]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col items-center w-full max-w-lg mt-5">

        <div class="text-teal-400 w-32 h-32 mb-4">
            @include('partials.logo-svg')
        </div>

        <div class="flex flex-col items-center text-center">
            <h1 class="text-4xl font-extrabold font-Tajawal leading-none"
                style="color: #0e7490; text-shadow: 1px 1px 0px #ffffff, 2px 2px 0px #a3c9d1, 3px 3px 0px #8eb4bd, 5px 5px 10px rgba(0,0,0,0.2);">
                نبض جوار
            </h1>
            <p class="mt-4 text-m font-bold font-Tajawal text-[#00336d]">
                "اختر نوع الحساب الذي ترغب بإنشائه"
            </p>



            <svg viewBox="0 0 300 240" class="w-60 h-60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="120" r="110" fill="#e0f7f9" fill-opacity="0.5"/>
                <circle cx="95" cy="125" r="28" fill="#00bcd4"/>
                <circle cx="95" cy="180" r="45" fill="#e0f2f1"/>
                <rect x="135" y="65" width="130" height="150" rx="15" fill="white" stroke="#b2ebf2" stroke-width="4"/>
                <rect x="155" y="95" width="85" height="6" rx="3" fill="#b2ebf2"/>
                <rect x="155" y="115" width="85" height="6" rx="3" fill="#b2ebf2"/>
                <rect x="155" y="135" width="55" height="6" rx="3" fill="#b2ebf2"/>
                <circle cx="250" cy="200" r="28" fill="#4db6ac"/>
                <path d="M240 200L247 207L262 192" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="w-full max-w-xs  space-y-2">
            <a href="{{ route('register.user') }}"
               class="flex items-center justify-center w-full min-h-[60px] bg-cyan-500 text-white text-lg font-bold rounded-2xl shadow-lg hover:bg-cyan-600 hover:shadow-cyan-500/30 transition-all active:scale-95">
                إنشاء حساب مستخدم
            </a>
            <a href="{{ route('register.nurse') }}"
               class="flex items-center justify-center w-full min-h-[60px] bg-teal-600 text-white text-lg font-bold rounded-2xl shadow-lg hover:bg-teal-700 hover:shadow-teal-600/30 transition-all active:scale-95">
                إنشاء حساب ممرض
            </a>
        </div>
    </div>
</div>
@endsection
