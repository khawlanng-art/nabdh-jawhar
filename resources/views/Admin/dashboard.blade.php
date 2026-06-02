@extends('layouts.layoutadmin')

@section('contents')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

 <button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>
    <div class="main-content" zoom: 0.50;>


        <div class="flex justify-between items-center mb-10">
            <div>

                <h1 class="text-1xl font-black text-slate-500">نظام إدارة طلبات التمريض والمرضى</h1>


            </div>
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-xl animate-bounce">
                    {{ session('success') }}
                </div>
            @endif
        </div>
@php

    $maxPendingTarget  = 15;
    $maxActiveTarget   = 50;
    $maxPatientsTarget = 100;
    $maxServicesTarget = 20;


    $pendingCount  = $pendingNurses->count();
    $activeCount   = $activeNurses->count();

    $pendingPercent  = $maxPendingTarget  > 0 ? min(($pendingCount / $maxPendingTarget) * 100, 100) : 0;
    $activePercent   = $maxActiveTarget   > 0 ? min(($activeCount / $maxActiveTarget) * 100, 100) : 0;
    $patientsPercent = $maxPatientsTarget > 0 ? min(($totalPatients / $maxPatientsTarget) * 100, 100) : 0;
    $servicesPercent = $maxServicesTarget > 0 ? min(($totalServices / $maxServicesTarget) * 100, 100) : 0;
@endphp

<div id="stats" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8" dir="rtl">

    <div class="stat-card relative overflow-hidden bg-gradient-to-b from-white/90 to-white/60 backdrop-blur-xl p-6 rounded-2xl border-t-2 border-l-2 border-white shadow-[12px_12px_24px_rgba(249,115,22,0.1),-4px_-4px_12px_rgba(255,255,255,0.9),inset_4px_4px_8px_rgba(255,255,255,0.6),inset_-4px_-4px_8px_rgba(249,115,22,0.05)] hover:-translate-y-2 hover:shadow-[20px_20px_35px_rgba(249,115,22,0.18)] transition-all duration-300 group flex flex-col justify-between min-h-[170px]">
        <div class="absolute -right-8 -top-8 w-28 h-28 bg-orange-400/15 rounded-full blur-2xl group-hover:scale-125 transition-all duration-500"></div>

        <div class="flex justify-between items-start relative z-10">
            <div class="space-y-1">
                <p class="text-[11px] font-black text-slate-400 tracking-wider uppercase">طلبات الانتظار</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight tabular-nums drop-shadow-[2px_3px_0px_rgba(249,115,22,0.15)] group-hover:text-orange-600 transition-colors">{{ $pendingCount }}</h3>
            </div>
            <span class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-600 text-white rounded-xl flex items-center justify-center border-t border-l border-white/40 shadow-[5px_5px_10px_rgba(249,115,22,0.4),-2px_-2px_6px_rgba(255,255,255,0.3),inset_2px_2px_4px_rgba(255,255,255,0.4)] transform group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-clock-rotate-left text-xl drop-shadow-[0_2px_3px_rgba(0,0,0,0.2)]"></i>
            </span>
        </div>

        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mt-4 relative z-10 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.05),inset_-2px_-2px_5px_rgba(255,255,255,0.7)] p-[2px]">
            <div class="h-full bg-gradient-to-r from-orange-400 to-orange-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.6)] transition-all duration-500"
                 style="width: {{ $pendingPercent }}%"></div>
        </div>
    </div>

    <div class="stat-card relative overflow-hidden bg-gradient-to-b from-white/90 to-white/60 backdrop-blur-xl p-6 rounded-2xl border-t-2 border-l-2 border-white shadow-[12px_12px_24px_rgba(16,185,129,0.1),-4px_-4px_12px_rgba(255,255,255,0.9),inset_4px_4px_8px_rgba(255,255,255,0.6),inset_-4px_-4px_8px_rgba(16,185,129,0.05)] hover:-translate-y-2 hover:shadow-[20px_20px_35px_rgba(16,185,129,0.18)] transition-all duration-300 group flex flex-col justify-between min-h-[170px]">
        <div class="absolute -right-8 -top-8 w-28 h-28 bg-emerald-400/15 rounded-full blur-2xl group-hover:scale-125 transition-all duration-500"></div>

        <div class="flex justify-between items-start relative z-10">
            <div class="space-y-1">
                <p class="text-[11px] font-black text-slate-400 tracking-wider uppercase">الممرضين المعتمدين</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight tabular-nums drop-shadow-[2px_3px_0px_rgba(16,185,129,0.15)] group-hover:text-emerald-600 transition-colors">{{ $activeCount }}</h3>
            </div>
            <span class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-xl flex items-center justify-center border-t border-l border-white/40 shadow-[5px_5px_10px_rgba(16,185,129,0.4),-2px_-2px_6px_rgba(255,255,255,0.3),inset_2px_2px_4px_rgba(255,255,255,0.4)] transform group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-user-check text-xl drop-shadow-[0_2px_3px_rgba(0,0,0,0.2)]"></i>
            </span>
        </div>

        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mt-4 relative z-10 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.05),inset_-2px_-2px_5px_rgba(255,255,255,0.7)] p-[2px]">
            <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.6)] transition-all duration-500"
                 style="width: {{ $activePercent }}%"></div>
        </div>
    </div>

    <div class="stat-card relative overflow-hidden bg-gradient-to-b from-white/90 to-white/60 backdrop-blur-xl p-6 rounded-2xl border-t-2 border-l-2 border-white shadow-[12px_12px_24px_rgba(59,130,246,0.1),-4px_-4px_12px_rgba(255,255,255,0.9),inset_4px_4px_8px_rgba(255,255,255,0.6),inset_-4px_-4px_8px_rgba(59,130,246,0.05)] hover:-translate-y-2 hover:shadow-[20px_20px_35px_rgba(59,130,246,0.18)] transition-all duration-300 group flex flex-col justify-between min-h-[170px]">
        <div class="absolute -right-8 -top-8 w-28 h-28 bg-blue-400/15 rounded-full blur-2xl group-hover:scale-125 transition-all duration-500"></div>

        <div class="flex justify-between items-start relative z-10">
            <div class="space-y-1">
                <p class="text-[11px] font-black text-slate-400 tracking-wider uppercase">إجمالي المرضى</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight tabular-nums drop-shadow-[2px_3px_0px_rgba(59,130,246,0.15)] group-hover:text-blue-600 transition-colors">{{ $totalPatients }}</h3>
            </div>
            <span class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 text-white rounded-xl flex items-center justify-center border-t border-l border-white/40 shadow-[5px_5px_10px_rgba(59,130,246,0.4),-2px_-2px_6px_rgba(255,255,255,0.3),inset_2px_2px_4px_rgba(255,255,255,0.4)] transform group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-hospital-user text-xl drop-shadow-[0_2px_3px_rgba(0,0,0,0.2)]"></i>
            </span>
        </div>

        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mt-4 relative z-10 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.05),inset_-2px_-2px_5px_rgba(255,255,255,0.7)] p-[2px]">
            <div class="h-full bg-gradient-to-r from-blue-400 to-blue-500 rounded-full shadow-[0_0_10px_rgba(59,130,246,0.6)] transition-all duration-500"
                 style="width: {{ $patientsPercent }}%"></div>
        </div>
    </div>

    <div class="stat-card relative overflow-hidden bg-gradient-to-b from-white/90 to-white/60 backdrop-blur-xl p-6 rounded-2xl border-t-2 border-l-2 border-white shadow-[12px_12px_24px_rgba(245,158,11,0.1),-4px_-4px_12px_rgba(255,255,255,0.9),inset_4px_4px_8px_rgba(255,255,255,0.6),inset_-4px_-4px_8px_rgba(245,158,11,0.05)] hover:-translate-y-2 hover:shadow-[20px_20px_35px_rgba(245,158,11,0.18)] transition-all duration-300 group flex flex-col justify-between min-h-[170px]">
        <div class="absolute -right-8 -top-8 w-28 h-28 bg-amber-400/15 rounded-full blur-2xl group-hover:scale-125 transition-all duration-500"></div>

        <div class="flex justify-between items-start relative z-10">
            <div class="space-y-1">
                <p class="text-[11px] font-black text-slate-400 tracking-wider uppercase">عدد الخدمات الطبية</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight tabular-nums drop-shadow-[2px_3px_0px_rgba(245,158,11,0.15)] group-hover:text-amber-600 transition-colors">{{ $totalServices }}</h3>
            </div>
            <span class="w-14 h-14 bg-gradient-to-br from-amber-400 to-amber-500 text-white rounded-xl flex items-center justify-center border-t border-l border-white/40 shadow-[5px_5px_10px_rgba(245,158,11,0.4),-2px_-2px_6px_rgba(255,255,255,0.3),inset_2px_2px_4px_rgba(255,255,255,0.4)] transform group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-briefcase-medical text-xl drop-shadow-[0_2px_3px_rgba(0,0,0,0.2)]"></i>
            </span>
        </div>

        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mt-4 relative z-10 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.05),inset_-2px_-2px_5px_rgba(255,255,255,0.7)] p-[2px]">
            <div class="h-full bg-gradient-to-r from-amber-400 to-amber-500 rounded-full shadow-[0_0_10px_rgba(245,158,11,0.6)] transition-all duration-500"
                 style="width: {{ $servicesPercent }}%"></div>
        </div>
    </div>

</div>
        <div id="new-requests" class="mb-12">
          <h2 class="text-xl font-black text-slate-800 mb-5 flex items-center gap-3 relative select-none" dir="rtl">

    <span class="w-3.5 h-8 bg-gradient-to-b from-orange-400 via-orange-500 to-orange-600 rounded-full
                 border-t border-l border-white/50
                 shadow-[4px_4px_10px_rgba(249,115,22,0.45),inset_2px_2px_4px_rgba(255,255,255,0.6),inset_-2px_-2px_4px_rgba(0,0,0,0.2)]
                 animate-pulse duration-[3000ms]">
    </span>

    <span class="drop-shadow-[2px_3px_0px_rgba(0,0,0,0.08)] tracking-wide">
        طلبات انضمام ممرضين
    </span>

</h2>
            <div class="overflow-x-auto">
   <div class="w-full overflow-hidden rounded-[20px] border-2 border-slate-300 bg-white shadow-[0_12px_40px_rgba(0,0,0,0.06)]" dir="rtl">
    <table class="w-full border-collapse text-right bg-white">
        <thead class="bg-slate-100 border-b border-slate-300 text-xs font-black text-slate-800 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 text-right font-black w-1/4">الممرض/ة</th>
                <th class="px-6 py-4 text-right font-black w-1/4">البريد الإلكتروني</th>

                <th class="px-6 py-4 text-center font-black w-1/4">الإجراءات</th>
            </tr>
    </thead>
    <tbody class="divide-y divide-slate-50">
        @forelse($pendingNurses as $nurse)
        <tr class="hover:bg-orange-50/30 transition-colors" >
            <td class="px-6 py-4 font-bold text-slate-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-black">
                                    <img src="{{ asset('storage/' . $nurse->profile->ProfilePicture) }}"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=EBF4FF&color=1E40AF&bold=true'"
                                     class="w-full h-full rounded-full object-cover border-2 border-slate-300 shadow-sm ring-1 ring-slate-200">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base">{{ $nurse->Username }}</span>
                        <span class="text-[10px] text-slate-400 font-medium">{{ $nurse->profile->Specialization ?? 'تخصص غير محدد' }}</span>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
            <span class="text-base text-slate-600 font-medium">{{ $nurse->email }}</span>
            </td>
    <td class="px-6 py-4 text-center">
    <div class="flex justify-center items-center gap-2">
        <button onclick="openModal('view-{{ $nurse->UserID }}')"
                class="w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-600 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-all border border-slate-200"
                title="مراجعة الملف والوثائق">
            <i class="fa-solid fa-eye text-sm"></i>
        </button>

        <form action="{{ route('admin.approve', $nurse->UserID) }}" method="POST" class="m-0">
            @csrf @method('PATCH')
            <button type="submit"
                    class="h-10 px-4 flex items-center justify-center bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg hover:bg-emerald-600 hover:text-white hover:border-emerald-600 shadow-sm font-black text-xs transition-all">
                <i class="fa-solid fa-check-double ml-1.5"></i> قبول
            </button>
        </form>

        <form action="{{ route('admin.reject', $nurse->UserID) }}" method="POST" class="m-0">
            @csrf @method('PATCH')
            <button type="submit" onclick="return confirm('هل أنت متأكد؟')"
                    class="h-10 px-4 flex items-center justify-center bg-rose-50 text-rose-600 border border-rose-200 rounded-lg hover:bg-rose-600 hover:text-white hover:border-rose-600 shadow-sm font-black text-xs transition-all">
                <i class="fa-solid fa-xmark ml-1.5"></i> رفض
            </button>
        </form>
    </div>
</td>
               </tr>
<div id="view-{{ $nurse->UserID }}" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[9999] flex items-center justify-center p-4 transition-all duration-300">

    <div class="bg-white rounded-[24px] w-full max-w-4xl p-8 no-scrollbar shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] overflow-y-auto max-h-[90vh] relative border border-slate-100" dir="rtl">

        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-lg border border-green-100/50 shadow-xs">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-900">بيانات الملف  الشخصي للممرض</h3>

                </div>
            </div>
            <button type="button" onclick="closeModal('view-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 flex items-center justify-center transition duration-200 border border-slate-200/40">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-7 space-y-8">
                <div>
                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">المعلومات الأساسية والمهنية</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-1">
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الاسم الكامل</span>
                            <span class="text-sm text-slate-800 font-black">{{ $nurse->Username }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">التخصص المهني</span>
                            <span class="text-sm text-slate-700 font-bold">{!! $nurse->profile->Specialization ?? '<span class="text-slate-400">ممرض عام</span>' !!}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">جهة العمل الحالية</span>
                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->HospitalOrCenter ?? 'غير محدد' }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">رقم هاتف التواصل</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->profile->PhoneNumber ?? 'غير مسجل' }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl md:col-span-2">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">العنوان السكني بالتفصيل</span>
                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->Address ?? 'غير مسجل' }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الميلاد</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->profile->DateOfBirth ?? '---' }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الجنس</span>
                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->Gender == 'Male' ? 'ذكر' : 'أنثى' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">بيانات الأمان والمنصة</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-1">
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">البريد الإلكتروني المسجل</span>
                            <span class="text-sm text-slate-700 font-bold truncate select-all">{{ $nurse->email }}</span>
                        </div>
                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الانضمام للنظام</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col justify-start space-y-6">

                <div>
                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">الوثائق والشهادات الرقمية</h4>
                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $docs = [
                                ['title' => 'الصورة الشخصية', 'field' => 'ProfilePicture'],
                                ['title' => 'شهادة التخرج والممارسة', 'field' => 'HealthCertificate']
                            ];
                        @endphp

                        @foreach($docs as $doc)
                            <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl hover:border-blue-500 hover:bg-white hover:shadow-md transition-all duration-300 group cursor-pointer text-center"
                                 onclick="showFullImage('{{ asset('storage/' . $nurse->profile->{$doc['field']}) }}')">
                                <span class="text-[10px] font-black text-slate-400 block mb-2 tracking-wide">{{ $doc['title'] }}</span>
                                <div class="aspect-square w-full max-w-[130px] mx-auto overflow-hidden rounded-lg bg-white relative border border-slate-200/60 shadow-xs">
                                    <img src="{{ asset('storage/' . $nurse->profile->{$doc['field']}) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-xs">
                                        <div class="w-8 h-8 rounded-full bg-white/20 text-white flex items-center justify-center border border-white/30 text-sm shadow-xs">
                                            <i class="fa-solid fa-expand"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>

        </div>

        <button type="button" onclick="closeModal('view-{{ $nurse->UserID }}')" class="mt-8 w-full py-3 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition-all duration-200 border border-slate-200/10">
            إغلاق شاشة المعاينة
        </button>

    </div>
</div>
        @empty
     <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">
           لا توجد طلبات انضمام جديدة حالياً
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
            </div>
        </div>
<div id="active-nurses" class="mb-12">
    <div class="flex justify-between items-center mb-6">
     <h2 class="text-xl font-black text-slate-800 flex items-center gap-3 mb-4 relative select-none" dir="rtl">

    <span class="w-3.5 h-8 bg-gradient-to-b from-emerald-400 via-emerald-500 to-emerald-600 rounded-full
                 border-t border-l border-white/50
                 shadow-[4px_4px_10px_rgba(16,185,129,0.45),inset_2px_2px_4px_rgba(255,255,255,0.6),inset_-2px_-2px_4px_rgba(0,0,0,0.2)]">
    </span>

    <span class="drop-shadow-[2px_3px_0px_rgba(0,0,0,0.08)] tracking-wide">
        طاقم التمريض المعتمد
    </span>

</h2>
    </div>

    <div class="w-full overflow-hidden rounded-[20px] border-2 border-slate-300 bg-white shadow-[0_12px_40px_rgba(0,0,0,0.06)]" dir="rtl">
        <table class="w-full border-collapse text-right bg-white">
            <thead>
                <tr class="bg-slate-100 border-b border-slate-300 text-xs font-black text-slate-800 uppercase tracking-wider">
                    <th class="px-6 py-4 font-black text-right">الممرض</th>
                    <th class="px-6 py-4 font-black text-right">البريد الإلكتروني</th>
                    <th class="px-6 py-4 font-black text-center">الحالة</th>
                    <th class="px-6 py-4 font-black text-center">الإجراءات</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white text-sm font-bold text-slate-800">

                @forelse($activeNurses as $nurse)
<tr class="searchable-item hover:bg-blue-50/40 border-b border-slate-200 last:border-none transition-colors duration-200 group" data-id="{{ $nurse->UserID }}">


                    <td class="px-6 py-4 bg-white">
                        <div class="flex items-center gap-3 justify-start">
                            <div class="w-11 h-11 shrink-0 relative">
                                <img src="{{ asset('storage/' . $nurse->profile->ProfilePicture) }}"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=EBF4FF&color=1E40AF&bold=true'"
                                     class="w-full h-full rounded-full object-cover border-2 border-slate-300 shadow-sm ring-1 ring-slate-200">
                                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 {{ $nurse->Status == 'Available' ? 'bg-green-500' : 'bg-slate-400' }} rounded-full border-2 border-white"></span>
                            </div>
                            <div class="flex flex-col text-right">
                                <span class="text-slate-950 font-black group-hover:text-blue-700 transition-colors duration-200 leading-tight">{{ $nurse->Username }}</span>
                                <span class="text-xs text-emerald-700 font-extrabold mt-0.5 border-none">
                                    {{ $nurse->profile->Specialization ?? 'تمريض عام' }}
                                </span>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-right bg-white">
                        <span class="text-slate-900 font-bold select-all">{{ $nurse->email }}</span>
                    </td>

                    <td class="px-6 py-4 text-center bg-white">
                        @php
                            $statusStyles = [
                                'Available' => 'bg-green-100 text-green-800 border border-green-300',
                                'Offline'   => 'bg-slate-100 text-slate-700 border border-slate-300',
                                'Busy'      => 'bg-red-100 text-red-800 border border-red-300'
                            ];
                            $currentClass = $statusStyles[$nurse->Status] ?? 'bg-orange-100 text-orange-800 border border-orange-300';
                            $statusAr = ['Available' => 'متاح', 'Offline' => 'غير متصل', 'Busy' => 'مشغول'];
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-black {{ $currentClass }}">
                            {{ $statusAr[$nurse->Status] ?? 'استراحة' }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center bg-white">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openModal('view-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition border border-slate-300" title="التفاصيل">
                                <i class="fa-solid fa-circle-info text-xs"></i>
                            </button>

                            <button onclick="openModal('edit-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 hover:bg-amber-50 hover:text-amber-600 flex items-center justify-center transition border border-slate-300" title="تعديل">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </button>

                            <button onclick="openModal('delete-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600 flex items-center justify-center transition border border-slate-300" title="حذف">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <div id="view-{{ $nurse->UserID }}" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[9999] flex items-center justify-center p-4 transition-all duration-300">
                    <div class="bg-white rounded-[24px] w-full max-w-4xl p-8 no-scrollbar shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] overflow-y-auto max-h-[90vh] relative border border-slate-100" dir="rtl">
                        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-lg border border-green-100/50 shadow-xs">
                                    <i class="fa-solid fa-address-card"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">بيانات الملف الشخصي للممرض</h3>
                                </div>
                            </div>
                            <button type="button" onclick="closeModal('view-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 flex items-center justify-center transition duration-200 border border-slate-200/40">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                            <div class="lg:col-span-7 space-y-8">
                                <div>
                                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">المعلومات الأساسية والمهنية</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-1">
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الاسم الكامل</span>
                                            <span class="text-sm text-slate-800 font-black">{{ $nurse->Username }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">التخصص المهني</span>
                                            <span class="text-sm text-slate-700 font-bold">{!! $nurse->profile->Specialization ?? '<span class="text-slate-400">ممرض عام</span>' !!}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">جهة العمل الحالية</span>
                                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->HospitalOrCenter ?? 'غير محدد' }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">رقم هاتف التواصل</span>
                                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->profile->PhoneNumber ?? 'غير مسجل' }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl md:col-span-2">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">العنوان السكني بالتفصيل</span>
                                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->Address ?? 'غير مسجل' }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الميلاد</span>
                                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->profile->DateOfBirth ?? '---' }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الجنس</span>
                                            <span class="text-sm text-slate-700 font-bold">{{ $nurse->profile->Gender == 'Male' ? 'ذكر' : 'أنثى' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">بيانات الأمان والمنصة</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-1">
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">البريد الإلكتروني المسجل</span>
                                            <span class="text-sm text-slate-700 font-bold truncate select-all">{{ $nurse->email }}</span>
                                        </div>
                                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الانضمام للنظام</span>
                                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $nurse->created_at->format('Y-m-d') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-5 flex flex-col justify-start space-y-6">
                                <div>
                                    <h4 class="text-xs font-black text-green-600 uppercase tracking-widest border-r-4 border-green-500 pr-3 mb-4">الوثائق والشهادات الرقمية</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        @php
                                            $docs = [
                                                ['title' => 'الصورة الشخصية', 'field' => 'ProfilePicture'],
                                                ['title' => 'شهادة التخرج والممارسة', 'field' => 'HealthCertificate']
                                            ];
                                        @endphp

                                        @foreach($docs as $doc)
                                            <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl hover:border-blue-500 hover:bg-white hover:shadow-md transition-all duration-300 group cursor-pointer text-center"
                                                 onclick="showFullImage('{{ asset('storage/' . $nurse->profile->{$doc['field']}) }}')">
                                                <span class="text-[10px] font-black text-slate-400 block mb-2 tracking-wide">{{ $doc['title'] }}</span>
                                                <div class="aspect-square w-full max-w-[130px] mx-auto overflow-hidden rounded-lg bg-white relative border border-slate-200/60 shadow-xs">
                                                    <img src="{{ asset('storage/' . $nurse->profile->{$doc['field']}) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                    <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-xs">
                                                        <div class="w-8 h-8 rounded-full bg-white/20 text-white flex items-center justify-center border border-white/30 text-sm shadow-xs">
                                                            <i class="fa-solid fa-expand"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="bg-slate-50 border border-slate-200/60 p-4 rounded-xl relative overflow-hidden shadow-xs">
                                    <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-blue-500/5 rounded-full blur-xl"></div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">مؤشر تقييم الأداء الحالي</span>
                                    <div class="flex items-center gap-2">
                                        @php
                                            $currentRating = $nurse->profile->AvgRating ?? 0;
                                            $fullStars = floor($currentRating);
                                        @endphp
                                        <div class="flex items-center gap-1 justify-end" dir="ltr">
                                            <span class="text-slate-700 font-black text-xs pr-1 tabular-nums">{{ number_format($currentRating, 1) }}</span>
                                            <div class="flex items-center gap-0.5">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $fullStars)
                                                        <svg class="w-3.5 h-3.5 text-amber-400 fill-current" viewBox="0 0 20 20" style="color: #fbbf24;">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-3.5 h-3.5 text-slate-200 fill-current" viewBox="0 0 20 20" style="color: #e2e8f0;">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="closeModal('view-{{ $nurse->UserID }}')" class="mt-8 w-full py-3 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition-all duration-200 border border-slate-200/10">
                            إغلاق شاشة المعاينة
                        </button>
                    </div>
                </div>

                <div id="edit-{{ $nurse->UserID }}" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[9999] flex items-center justify-center p-4 transition-all duration-300">
                    <div class="bg-white rounded-[24px] w-full max-w-2xl p-8 no-scrollbar shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] text-right overflow-y-auto max-h-[90vh] border border-slate-100" dir="rtl">
                        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                            <h3 class="text-xl font-black text-slate-900 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-lg shadow-sm border border-blue-100/50">
                                    <i class="fa-solid fa-user-gear"></i>
                                </div>
                                تعديل بيانات الملف الشخصي للممرض
                            </h3>
                            <button type="button" onclick="closeModal('edit-{{ $nurse->UserID }}')" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 flex items-center justify-center transition duration-200">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </button>
                        </div>

                        <form action="{{ route('admin.nurse.update', $nurse->UserID) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">الاسم الكامل</label>
                                    <input type="text" name="Username" value="{{ $nurse->Username }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">رقم الهاتف</label>
                                    <input type="text" name="PhoneNumber" value="{{ $nurse->profile->PhoneNumber ?? '' }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800 tabular-nums">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">التخصص</label>
                                    <input type="text" name="Specialization" value="{{ $nurse->profile->Specialization ?? '' }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">جهة العمل</label>
                                    <input type="text" name="HospitalOrCenter" value="{{ $nurse->profile->HospitalOrCenter ?? '' }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800">
                                </div>
                                <div class="space-y-1.5 md:col-span-2">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">العنوان بالتفصيل</label>
                                    <input type="text" name="Address" value="{{ $nurse->profile->Address ?? '' }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">تاريخ الميلاد</label>
                                    <input type="date" name="DateOfBirth" value="{{ $nurse->profile->DateOfBirth ?? '' }}" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-extrabold text-slate-400 pr-1 uppercase tracking-wider block">الجنس</label>
                                    <select name="Gender" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-blue-500 focus:bg-white focus:shadow-[0_0_0_4px_rgba(59,130,246,0.1)] outline-none transition duration-200 text-sm font-bold text-slate-800 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%22fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2364748B%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_12px] bg-[position:left_16px_center] bg-no-repeat">
                                        <option value="Male" {{ $nurse->profile->Gender == 'Male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="Female" {{ $nurse->profile->Gender == 'Female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                                <button type="button" onclick="closeModal('edit-{{ $nurse->UserID }}')" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition duration-200">إلغاء التعديل</button>
                                <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-green-600 hover:bg-green-700 shadow-[0_4px_12px_rgba(59,130,246,0.25)] transition duration-200">حفظ التغييرات</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="delete-{{ $nurse->UserID }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
                    <div class="bg-white rounded-[2rem] w-full max-w-sm p-8 text-center" dir="rtl">
                        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fa-solid fa-trash-can"></i></div>
                        <h3 class="text-xl font-black text-slate-800 mb-2 italic">حذف نهائي؟</h3>
                        <p class="text-sm text-slate-500 mb-6">أنت على وشك حذف حساب الممرض <span class="text-red-600 font-bold italic">{{ $nurse->Username }}</span>، لا يمكن استرجاع البيانات بعد ذلك.</p>
                        <div class="flex gap-3">
                            <form action="{{ url('/nurse/delete/' . $nurse->UserID) }}" method="POST" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-xl font-black">نعم، احذف</button>
                            </form>
                            <button onclick="closeModal('delete-{{ $nurse->UserID }}')" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-bold italic">إلغاء</button>
                        </div>
                    </div>
                </div>

                @empty
             <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">لا يوجد ممرضين مسجلين بعد</td></tr>
                @endforelse

            </tbody>
        </table>

        <div id="imageLightbox" class="hidden fixed inset-0 bg-black/95 z-[10000] flex items-center justify-center p-6 backdrop-blur-sm">
            <button onclick="closeFullImage()" class="absolute top-8 left-8 w-14 h-14 bg-white/10 hover:bg-red-500 text-white rounded-full transition-all flex items-center justify-center shadow-2xl">
                <i class="fa-solid fa-xmark text-3xl"></i>
            </button>
            <img id="lightboxImg" src="" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl border-2 border-white/20 object-contain">
        </div>

    </div>
</div>

<div id="patients" class="mb-12 no-scrollbar" >

  <div class="flex items-center justify-between mb-6">


        <h2 class="text-xl font-black text-slate-800 flex items-center gap-3 mb-4 relative select-none" dir="rtl">

    <span class="w-3.5 h-8 bg-gradient-to-b from-blue-400 via-blue-500 to-blue-600 rounded-full
                 border-t border-l border-white/50
                 shadow-[4px_4px_10px_rgba(59,130,246,0.45),inset_2px_2px_4px_rgba(255,255,255,0.6),inset_-2px_-2px_4px_rgba(0,0,0,0.2)]">
    </span>

    <span class="drop-shadow-[2px_3px_0px_rgba(0,0,0,0.08)] tracking-wide">
        سجل المرضى
    </span>

</h2>




    </div>

 <div class="w-full overflow-hidden rounded-[20px] border-2 border-slate-300 bg-white shadow-[0_12px_40px_rgba(0,0,0,0.06)]" dir="rtl">
    <table class="w-full border-collapse text-right">
        <thead>
            <tr class="bg-slate-100 border-b border-slate-300 text-xs font-black text-slate-800 uppercase tracking-wider">
                <th class="px-6 py-4 font-black text-right">اسم المريض</th>
                <th class="px-6 py-4 font-black text-center">البريد الإلكتروني</th>
                <th class="px-6 py-4 font-black text-center">تاريخ التسجيل</th>
                <th class="px-6 py-4 font-black text-center">الإجراءات</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200 text-sm font-bold text-slate-800">

            @forelse($allPatients as $patient)
<tr class="searchable-item hover:bg-blue-50/40 border-b border-slate-200 last:border-none transition-colors duration-200 group" data-id="{{ $patient->UserID }}">


                <td class="px-6 py-4 text-right">
                    <div class="flex items-center gap-3 justify-start">
                       <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-black text-sm uppercase border border-blue-300">
   @if($patient->profile && $patient->profile->ProfilePicture)
        <img src="{{ asset('storage/' . $patient->profile->ProfilePicture) }}?v={{ time() }}"
             class="user-avatar w-12 h-12 rounded-full border-2 border-slate-200 object-cover">
    @else
        <div class="w-12 h-12 rounded-full border-2 border-slate-200 bg-cyan-600 flex items-center justify-center text-white font-bold text-lg">
            {{ mb_substr($patient->Username, 0, 1) }}
        </div>
    @endif
</div>
                        <span class="text-slate-950 font-black group-hover:text-blue-700 transition-colors duration-200 leading-tight">{{ $patient->Username }}</span>
                    </div>
                </td>

                <td class="px-6 py-4 text-center">
                    <span class="text-slate-900 font-bold select-all">{{ $patient->email }}</span>
                </td>

                <td class="px-6 py-4 text-center tabular-nums text-slate-700 font-black">
                    {{ $patient->created_at->format('Y-m-d') }}
                </td>

                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">

                        <button onclick="openModal('view-patient-{{ $patient->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition border border-slate-300" title="التفاصيل">
                            <i class="fa-solid fa-circle-info text-xs"></i>
                        </button>

                        <button onclick="openModal('edit-patient-{{ $patient->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 hover:bg-amber-50 hover:text-amber-600 flex items-center justify-center transition border border-slate-300" title="تعديل">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </button>

                        <button onclick="openModal('delete-{{ $patient->UserID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600 flex items-center justify-center transition border border-slate-300" title="حذف">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>

                    </div>
                </td>

            </tr>
<div id="view-patient-{{ $patient->UserID }}" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[9999] flex items-center justify-center p-4 transition-all duration-300">

    <div class="bg-white rounded-[24px] w-full max-w-4xl p-8 no-scrollbar shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] overflow-y-auto max-h-[90vh] relative border border-slate-100" dir="rtl">

        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg border border-blue-100/50 shadow-xs">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-900">بيانات الملف الشخصي للمريض</h3>
                </div>
            </div>
            <button type="button" onclick="closeModal('view-patient-{{ $patient->UserID }}')" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 flex items-center justify-center transition duration-200 border border-slate-200/40">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-7 space-y-8">
                <div>
                    <h4 class="text-xs font-black text-blue-600 uppercase tracking-widest border-r-4 border-blue-600 pr-3 mb-4">المعلومات الشخصية</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-1">

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الاسم الكامل</span>
                            <span class="text-sm text-slate-800 font-black">{{ $patient->Username }}</span>
                        </div>

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">رقم الجوال</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $patient->profile->PhoneNumber ?? 'غير مسجل' }}</span>
                        </div>

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الميلاد</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $patient->profile->DateOfBirth ?? '---' }}</span>
                        </div>

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الجنس</span>
                            <span class="text-sm text-slate-700 font-bold">{{ $patient->profile?->Gender == 'Male' ? 'ذكر' : 'أنثى' }}</span>
                        </div>

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl md:col-span-2">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">العنوان السكني بالتفصيل</span>
                            <span class="text-sm text-slate-700 font-bold leading-relaxed">{{ $patient->profile->Address ?? 'لا يوجد عنوان مسجل' }}</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col justify-start space-y-6">
                <div>
                    <h4 class="text-xs font-black text-blue-600 uppercase tracking-widest border-r-4 border-blue-600 pr-3 mb-4">بيانات الأمان</h4>
                    <div class="space-y-4">

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">البريد الإلكتروني المسجل</span>
                            <span class="text-sm text-slate-700 font-bold truncate select-all">{{ $patient->email }}</span>
                        </div>

                        <div class="flex flex-col bg-slate-50/60 border border-slate-100 p-3 rounded-xl">
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الانضمام للنظام</span>
                            <span class="text-sm text-slate-700 font-bold tabular-nums">{{ $patient->created_at->format('Y-m-d') }}</span>
                        </div>

                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl relative overflow-hidden shadow-xs">
                    <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-blue-500/10 rounded-full blur-xl"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-blue-600 text-lg">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-blue-700 uppercase tracking-wide block">حالة الحساب</span>
                            <span class="text-xs font-bold text-slate-500">الملف الشخصي مفعل ومحمي بموجب شروط الخصوصية</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button type="button" onclick="closeModal('view-patient-{{ $patient->UserID }}')" class="mt-8 w-full py-3 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition-all duration-200 border border-slate-200/10">
            إغلاق شاشة المعاينة
        </button>

    </div>
</div>


<div id="edit-patient-{{ $patient->UserID }}" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[9999] flex items-center justify-center p-4 transition-all duration-300">

    <div class="bg-white rounded-[24px] w-full max-w-2xl p-8 shadow-[0_25px_50px_-12px_rgba(15,23,42,0.25)] no-scrollbar overflow-y-auto max-h-[90vh] relative border border-slate-100" dir="rtl">

        <form action="{{ route('admin.patients.update', $patient->UserID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg border border-blue-100/50 shadow-xs">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">تعديل بيانات الملف الشخصي للمريض</h3>
                    </div>
                </div>
                <button type="button" onclick="closeModal('edit-patient-{{ $patient->UserID }}')" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 hover:bg-rose-50 flex items-center justify-center transition duration-200 border border-slate-200/40">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="space-y-6 text-right">
                <h4 class="text-xs font-black text-blue-600 uppercase tracking-widest border-r-4 border-blue-600 pr-3 mb-4">المعلومات الشخصية</h4>

                <div class="space-y-4 pr-1">
                    <div class="flex flex-col">
                        <label class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الاسم الكامل</label>
                        <input type="text" name="Username" value="{{ $patient->Username ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200/70 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10 outline-none transition-all duration-200">
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">رقم الجوال</label>
                        <input type="text" name="PhoneNumber" value="{{ $patient->profile->PhoneNumber ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200/70 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10 outline-none transition-all duration-200 tabular-nums">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">تاريخ الميلاد</label>
                            <input type="date" name="DateOfBirth" value="{{ $patient->profile->DateOfBirth ?? '' }}" class="w-full bg-slate-50/60 border border-slate-200/70 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10 outline-none transition-all duration-200">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">الجنس</label>
                            <select name="Gender" class="w-full bg-slate-50/60 border border-slate-200/70 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10 outline-none transition-all duration-200">
                                <option value="Male" {{ $patient->profile?->Gender == 'Male' ? 'selected' : '' }}>ذكر</option>
                                <option value="Female" {{ $patient->profile?->Gender == 'Female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[10px] text-slate-400 font-extrabold uppercase mb-1 tracking-wide">العنوان السكني بالتفصيل</label>
                        <textarea name="Address" rows="3" class="w-full bg-slate-50/60 border border-slate-200/70 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/10 outline-none transition-all duration-200 resize-none leading-relaxed">{{ $patient->profile->Address ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 py-3.5 bg-blue-600 text-white rounded-xl text-sm font-black hover:bg-blue-700 transition-all duration-200 transform active:scale-98 shadow-md shadow-blue-600/10">
                    حفظ التعديلات الحالية
                </button>
                <button type="button" onclick="closeModal('edit-patient-{{ $patient->UserID }}')" class="flex-1 py-3.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition-all duration-200">
                    إلغاء التعديل
                </button>
            </div>

        </form>
    </div>
</div>
<div id="delete-{{ $patient->UserID }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
            <div class="bg-white rounded-[2rem] w-full max-w-sm p-8 text-center" dir="rtl">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fa-solid fa-trash-can"></i></div>
                <h3 class="text-xl font-black text-slate-800 mb-2 italic">حذف نهائي؟</h3>
                <p class="text-sm text-slate-500 mb-6">أنت على وشك حذف حساب المريض <span class="text-red-600 font-bold italic">{{ $patient->Username}}</span>، لا يمكن استرجاع البيانات بعد ذلك.</p>
                <div class="flex gap-3">
                    <form action="{{ url('/patient/delete/' . $patient->UserID) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-xl font-black">نعم، احذف</button>
                    </form>
                    <button onclick="closeModal('delete-{{$patient->UserID}}')" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-bold italic">إلغاء</button>
                </div>
            </div>
        </div>
                @empty
                <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">لا يوجد مرضى مسجلين بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div id="services-management" class="mb-12" dir="rtl ">
    <div class="flex justify-between items-center mb-6 ">
       <h2 class="text-xl font-black text-slate-800 flex items-center gap-3 mb-4 relative select-none" dir="rtl">

    <span class="w-3.5 h-8 bg-gradient-to-b from-amber-400 via-amber-500 to-amber-600 rounded-full
                 border-t border-l border-white/50
                 shadow-[4px_4px_10px_rgba(245,158,11,0.45),inset_2px_2px_4px_rgba(255,255,255,0.6),inset_-2px_-2px_4px_rgba(0,0,0,0.2)]">
    </span>

    <span class="drop-shadow-[2px_3px_0px_rgba(0,0,0,0.08)] tracking-wide">
        قائمة الخدمات الطبية
    </span>

</h2>
     <button onclick="openModal('add-service')"
        class="relative overflow-hidden bg-gradient-to-b from-amber-400 via-amber-500 to-amber-600 text-white px-6 py-3 rounded-xl font-black
               border-t border-l border-white/40
               shadow-[0_8px_20px_rgba(245,158,11,0.35),-2px_-2px_6px_rgba(255,255,255,0.2),inset_2px_2px_4px_rgba(255,255,255,0.3),inset_-2px_-2px_4px_rgba(0,0,0,0.15)]
               hover:-translate-y-0.5 hover:shadow-[0_12px_25px_rgba(245,158,11,0.5)]
               active:translate-y-0 active:shadow-[inset_2px_2px_5px_rgba(0,0,0,0.2)]
               transition-all duration-200 flex items-center gap-2 text-sm select-none group">

    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

    <i class="fa-solid fa-plus text-xs drop-shadow-[0_1px_2px_rgba(0,0,0,0.3)] transform group-hover:scale-110 transition-transform"></i>

    <span class="drop-shadow-[0_1.5px_2px_rgba(0,0,0,0.2)]">
        إضافة خدمة جديدة
    </span>
</button>
    </div>

    <div class="w-full overflow-hidden rounded-[20px] border-2 border-slate-300 bg-white shadow-[0_12px_40px_rgba(0,0,0,0.06)]" dir="rtl">
        <table class="w-full border-collapse text-right bg-white ">
            <thead class="bg-slate-100 border-b border-slate-300 text-xs font-black text-slate-800 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-right font-black w-[30%]">الخدمة</th>
                    <th class="px-6 py-4 text-right font-black w-[20%]">التصنيف</th>
                    <th class="px-6 py-4 text-center font-black w-[15%]">السعر الأساسي</th>
                    <th class="px-6 py-4 text-center font-black w-[15%]">الحالة</th>
                    <th class="px-6 py-4 text-center font-black w-[20%]">الإجراءات</th>
                </tr>

            </thead>
            <tbody class="divide-y divide-slate-50">

                @foreach($services as $service)

               <tr class="hover:bg-blue-50/10 transition-colors group searchable-item" data-id="{{ $service->ServiceID }}">
                    <td class="px-6 py-4 ">
                        <div class="flex items-center gap-3">
                          <div class="w-12 h-12 bg-blue-50 rounded-2xl overflow-hidden flex items-center justify-center border border-blue-100 relative">
    @if($service->IconURL)
        @if(Str::contains($service->IconURL, ['services/', '/', '.']))

           <img src="{{ Storage::url($service->IconURL) }}"
                 class="w-full h-full object-cover shadow-sm">
        @else

            <span class="text-2xl">{{ $service->IconURL }}</span>
        @endif
    @else

        <i class="fa-solid fa-stethoscope text-blue-500 text-xl"></i>
    @endif
</div>
                           <div class="flex flex-col">
                    <span class="text-sm font-bold text-slate-800">{{ $service->ServiceName }}</span>
<div class="max-w-[200px] truncate">
    <div class="truncate">
        <span class="text-[11px] text-slate-400 font-medium block truncate">
            {{ $service->Description }}
        </span>
    </div>
</div>
                </div>
                        </div>
                    </td>
                   <td class="px-6 py-4">
            <span class="px-2 py-1 bg-slate-50 text-slate-500 rounded-md text-[11px] font-bold border border-slate-200">
                {{ $service->CategoryName }}
            </span>
        </td>

        <td class="px-6 py-4 text-center text-sm font-black text-slate-700 tabular-nums">
            {{ number_format($service->BasePrice, 0) }} <span class="text-[10px] text-slate-400">ر.ي</span>
        </td>
                   <td class="px-6 py-4 text-center">
            @if($service->IsActive)
                <span class="px-2 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase">نشط</span>
            @else
                <span class="px-2 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase">متوقف</span>
            @endif
        </td>
                    <td class="px-8 py-4">
                        <div class="flex justify-center gap-2">
                            <button onclick="openModal('edit-service-{{ $service->ServiceID }}')"  class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 hover:bg-amber-50 hover:text-amber-600 flex items-center justify-center transition border border-slate-300" title="تعديل">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </button>

                            <button onclick="openModal('delete-service-{{ $service->ServiceID }}')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600 flex items-center justify-center transition border border-slate-300" title="حذف">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>

                        </div>
                    </td>
                </tr>
<div id="delete-service-{{ $service->ServiceID }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] w-full max-w-sm p-8 text-center" dir="rtl">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <h3 class="text-xl font-black text-slate-800 mb-2 italic">حذف الخدمة؟</h3>

        <p class="text-sm text-slate-500 mb-6">
            هل أنت متأكد من حذف خدمة <span class="text-red-600 font-bold italic">"{{ $service->ServiceName }}"</span>؟
            <br> لن تظهر هذه الخدمة في قائمة الطلبات بعد الآن.
        </p>

        <div class="flex gap-3">
            <form action="{{ route('admin.services.delete', $service->ServiceID) }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-3 bg-red-500 text-white rounded-xl font-black shadow-lg shadow-red-100 hover:bg-red-600 transition-all">
                    نعم، احذف
                </button>
            </form>

            <button onclick="closeModal('delete-service-{{ $service->ServiceID }}')" class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl font-bold italic hover:bg-slate-200 transition-all">
                إلغاء
            </button>
        </div>
    </div>
</div>
<div id="edit-service-{{ $service->ServiceID }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-4">
    <div class="bg-white rounded-[1.8rem] w-full max-w-2xl p-6 md:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.15)] text-right border border-slate-100 overflow-y-auto max-h-[90vh] no-scrollbar" dir="rtl">

        <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
            <h3 class="text-xl font-black text-slate-800 flex items-center gap-2.5">
                <span class="p-2 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                </span>
                تعديل بيانات الخدمة الطبية
            </h3>
            <button type="button" onclick="closeModal('edit-service-{{ $service->ServiceID }}')" class="text-slate-400 hover:text-red-500 hover:rotate-90 transition-all duration-300">
                <i class="fa-solid fa-circle-xmark text-2xl"></i>
            </button>
        </div>

        <form action="{{ route('admin.services.update', $service->ServiceID) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">اسم الخدمة العلاجية</label>
                    <input type="text" name="ServiceName" value="{{ $service->ServiceName }}"
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 shadow-inner placeholder:text-slate-400">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">تكلفة الخدمة (ر.ي)</label>
                    <input type="number" step="0.01" name="BasePrice" value="{{ $service->BasePrice }}"
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 tabular-nums shadow-inner">
                </div>

                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">حالة الإتاحة في نظام الرعاية</label>
                    <select name="IsActive" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-black text-slate-800 cursor-pointer shadow-inner">
                        <option value="1" {{ $service->IsActive == 1 ? 'selected' : '' }} class="text-green-600 font-bold">✅ نشط - تظهر للمرضى في التطبيق ومتاحة للممرضين</option>
                        <option value="0" {{ $service->IsActive == 0 ? 'selected' : '' }} class="text-red-600 font-bold">🚫 متوقف - مخفية مؤقتاً من النظام</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">التصنيف الرئيسي</label>
                    <input type="text" name="CategoryName" value="{{ $service->CategoryName }}"
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 shadow-inner">
                </div>

            </div>

            <div class="space-y-1.5">
                <label class="text-xs  font-black text-slate-700 mr-1 block">تفاصيل الخدمة</label>
                <textarea name="Description"
                          class="w-full border-2 border-slate-100 rounded-xl p-4 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all h-28 resize-none text-sm font-bold text-slate-800 leading-relaxed shadow-inner"
                          placeholder="اكتب هنا شروط تنفيذ الخدمة والمستلزمات الطبية المطلوبة من المريض أو الممرض...">{{ $service->Description }}</textarea>
            </div>

            <div class="space-y-4 pt-4">
                <div class="relative group h-auto border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 p-5 transition-all hover:border-amber-400">
                    <label class="block text-center text-xs font-black text-slate-500 mb-4">اختر رمز الرعاية أو ارفع صورة توضيحية</label>

                    @php
                    $emojis = [
                        '👩‍⚕️', '👨‍⚕️', '💉', '🩺', '💊', '🩹', '🌡️', '🧪', '🔬', '🩸', '🧬', '🦷', '🧠', '🦴',
                        '♿', '👨‍🦽', '👩‍🦽', '👨‍🦼', '👩‍🦼', '🦯', '👵', '👴', '🧓', '🛌', '🛋️', '🚶‍♂️', '🚶‍♀️', '🧎‍♂️', '🧎‍♀️',
                        '👶', '🧒', '🤰', '🤱', '👩‍🍼', '🍼', '🧸', '🚑', '🏥', '🚨', '🆘', '⚠️', '📞', '🔔', '⏱️',
                        '🧼', '🧤', '😷', '🧴', '🚿', '🧻', '🧽', '🗑️', '💦', '🛡️', '📋', '📝', '📁',
                        '🧘‍♀️', '🧘‍♂️', '💤', '💡', '✨', '💖', '🧡', '💛', '💚', '💙', '💜', '🤍', '💪', '👂', '👀',
                        '🏠', '🏘️', '🤝', '🤲', '🫂', '⚖️', '🔋', '🌱', '☀️', '🌈', '🏥', '🏨', '🏪', '🚑', '🚒', '🚁',
                        '👩‍💼', '👨‍💼', '🧑‍🏫', '⚖️', '🧺', '🧼', '🚿', '🚪', '🗝️', '📅', '📍', '🚩', '🏁'
                    ];
                    @endphp

                    <div id="emoji-container" class="grid grid-cols-4 sm:grid-cols-8 gap-3 transition-all duration-500 overflow-hidden">
                        @foreach($emojis as $index => $emoji)
                            <label class="emoji-item {{ $index >= 16 ? 'hidden' : '' }} cursor-pointer">
                                <input type="radio" name="ServiceIcon" value="{{ $emoji }}" class="hidden peer" onchange="selectIcon(this, 'emoji')">
                                <div class="h-11 w-11 flex items-center justify-center text-xl bg-white border border-slate-200/80 rounded-xl shadow-sm hover:bg-amber-50 hover:border-amber-300 peer-checked:border-amber-500 peer-checked:bg-amber-100/70 transition-all duration-200">
                                    {{ $emoji }}
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" id="toggle-btn" onclick="toggleEmojis()" class="text-[11px] font-black text-slate-500 hover:text-amber-600 transition-colors">
                            <i class="fa-solid fa-angles-down ml-1"></i> عرض المزيد من الرموز الطبية
                        </button>
                    </div>

                    <div class="border-t border-slate-200/60 my-5"></div>

                    <div class="relative">
                        <label class="block text-right text-xs font-black text-slate-600 mb-2">أو ارفع أيقونة خاصة بالخدمة:</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-16 border-2 border-slate-200 border-dotted rounded-xl cursor-pointer bg-white hover:bg-slate-50 transition-all group-hover:border-amber-300">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-sm"></i>
                                    <p class="text-xs text-slate-500 font-bold">اضغط لرفع صورة طبية مخصصة</p>
                                </div>
                                <input type="file" name="ServiceImage" class="hidden" accept="image/*" onchange="selectIcon(this, 'file')">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-[2] py-3.5 bg-amber-500 text-white rounded-xl font-black text-base shadow-lg shadow-amber-500/20 hover:bg-amber-600 hover:-translate-y-0.5 transition-all duration-200 active:scale-95">
                    حفظ تغييرات الخدمة
                </button>
                <button type="button" onclick="closeModal('edit-service-{{ $service->ServiceID }}')" class="flex-1 py-3.5 bg-slate-100 text-slate-600 rounded-xl font-bold text-base hover:bg-slate-200 transition-all duration-200">
                    تراجع
                </button>
            </div>
        </form>
    </div>
</div>

                @endforeach
<div id="add-service" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
    <div class="bg-white rounded-[1.8rem] w-full max-w-2xl p-6 md:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.15)] text-right border border-slate-100 overflow-y-auto max-h-[95vh] no-scrollbar" dir="rtl">

        <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
            <h3 class="text-xl font-black text-slate-800 flex items-center gap-2.5">
                <span class="p-2 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-folder-plus text-lg"></i>
                </span>
                إضافة خدمة طبية جديدة
            </h3>
            <button type="button" onclick="closeModal('add-service')" class="text-slate-400 hover:text-red-500 hover:rotate-90 transition-all duration-300">
                <i class="fa-solid fa-circle-xmark text-2xl"></i>
            </button>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">اسم الخدمة الطبية</label>
                    <input type="text" name="ServiceName" placeholder="مثلاً:تركيب كانيولا" required
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 shadow-inner placeholder:text-slate-400">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">السعر (ر.ي)</label>
                    <input type="number" step="0.01" name="BasePrice" placeholder="0.00" required
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 tabular-nums shadow-inner">
                </div>
     <div class="md:col-span-2 space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">وصف الخدمة</label>
                    <input type="text" name="Description" placeholder="اكتب وصف مختصر   .."
                           class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all text-sm font-bold text-slate-800 shadow-inner placeholder:text-slate-400">
                </div>
                <div class="md:col-span-1 space-y-1.5">
                    <label class="text-xs font-black text-slate-700 mr-1 block">تصنيف الخدمة</label>
                    <div class="relative">
                        <select name="CategoryName" class="w-full border-2 border-slate-100 rounded-xl p-3 bg-slate-50/50 focus:border-amber-500 focus:bg-white outline-none transition-all font-bold text-slate-800 appearance-none cursor-pointer shadow-inner">
                            <option value="تمريض">تمريض</option>
                            <option value="رعاية">رعاية</option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="space-y-4 pt-4">
                <label class="text-xs font-black text-slate-700 mr-1 block">صورة الخدمة التوضيحية</label>

                <div class="relative group h-auto border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 p-5 transition-all hover:border-amber-400">
                    <label class="block text-center text-xs font-black text-slate-500 mb-4">اختر رمز الرعاية أو ارفع صورة توضيحية</label>

                    @php
                    $emojis = [
                        '👩‍⚕️', '👨‍⚕️', '💉', '🩺', '💊', '🩹', '🌡️', '🧪', '🔬', '🩸', '🧬', '🦷', '🧠', '🦴',
                        '♿', '👨‍🦽', '👩‍🦽', '👨‍🦼', '👩‍🦼', '🦯', '👵', '👴', '🧓', '🛌', '🛋️', '🚶‍♂️', '🚶‍♀️', '🧎‍♂️', '🧎‍♀️',
                        '👶', '🧒', '🤰', '🤱', '👩‍🍼', '🍼', '🧸', '🚑', '🏥', '🚨', '🆘', '⚠️', '📞', '🔔', '⏱️',
                        '🧼', '🧤', '😷', '🧴', '🚿', '🧻', '🧽', '🗑️', '💦', '🛡️', '📋', '📝', '📁',
                        '🧘‍♀️', '🧘‍♂️', '💤', '💡', '✨', '💖', '🧡', '💛', '💚', '💙', '💜', '🤍', '💪', '👂', '👀',
                        '🏠', '🏘️', '🤝', '🤲', '🫂', '⚖️', '🔋', '🌱', '☀️', '🌈', '🏥', '🏨', '🏪', '🚑', '🚒', '🚁',
                        '👩‍💼', '👨‍💼', '🧑‍🏫', '⚖️', '🧺', '🧼', '🚿', '🚪', '🗝️', '📅', '📍', '🚩', '🏁'
                    ];
                    @endphp

                    <div id="emoji-container" class="grid grid-cols-4 sm:grid-cols-8 gap-3 transition-all duration-500 overflow-hidden">
                        @foreach($emojis as $index => $emoji)
                            <label class="emoji-item {{ $index >= 16 ? 'hidden' : '' }} cursor-pointer">
                                <input type="radio" name="ServiceIcon" value="{{ $emoji }}" class="hidden peer" onchange="selectIcon(this, 'emoji')">
                                <div class="h-11 w-11 flex items-center justify-center text-xl bg-white border border-slate-200/80 rounded-xl shadow-sm hover:bg-amber-50 hover:border-amber-300 peer-checked:border-amber-500 peer-checked:bg-amber-100/70 transition-all duration-200">
                                    {{ $emoji }}
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" id="toggle-btn" onclick="toggleEmojis()" class="text-[11px] font-black text-slate-500 hover:text-amber-600 transition-colors">
                            <i class="fa-solid fa-angles-down ml-1"></i> عرض المزيد من الرموز الطبية
                        </button>
                    </div>

                    <div class="border-t border-slate-200/60 my-5"></div>

                    <div class="relative">
                        <label class="block text-right text-xs font-black text-slate-600 mb-2">أو ارفع أيقونة خاصة بالخدمة:</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-16 border-2 border-slate-200 border-dotted rounded-xl cursor-pointer bg-white hover:bg-slate-50 transition-all group-hover:border-amber-300">
                                <div class="flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-sm"></i>
                                    <p class="text-xs text-slate-500 font-bold">اضغط لرفع صورة طبية مخصصة</p>
                                </div>
                                <input type="file" name="ServiceImage" class="hidden" accept="image/*" onchange="selectIcon(this, 'file')">
                            </label>
                        </div>
                    </div>

                    <div id="icon-preview" class="mt-4 flex flex-col items-center justify-center border-t border-slate-100 pt-4">
                        <p class="text-[10px] font-bold text-slate-500 mb-2">الشكل النهائي للأيقونة:</p>
                        <div id="preview-box" class="h-14 w-14 bg-white rounded-xl border-2 border-slate-200 flex items-center justify-center text-2xl shadow-sm overflow-hidden text-slate-400 font-bold">
                            ؟
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-50">
                <button type="submit" class="flex-[2] py-3.5 bg-amber-500 text-white rounded-xl font-black text-base shadow-lg shadow-amber-500/20 hover:bg-amber-600 hover:-translate-y-0.5 transition-all duration-200 active:scale-95">
                    إعتماد وحفظ الخدمة
                </button>
                <button type="button" onclick="closeModal('add-service')" class="flex-1 py-3.5 bg-slate-100 text-slate-600 rounded-xl font-bold text-base hover:bg-slate-200 transition-all duration-200">
                    إلغاء
                </button>
            </div>
        </form>
    </div>
</div>


@forelse($services as $service)

@empty
       <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">

                  لا توجد خدمات مضافة في النظام بعد

            </td>
        </tr>
    @endforelse

            </tbody>
        </table>
    </div>
</div>

<script>

function toggleEmojis() {
    const hiddenItems = document.querySelectorAll('.emoji-item.hidden');
    const allItems = document.querySelectorAll('.emoji-item');
    const btn = document.getElementById('toggle-btn');
    const container = document.getElementById('emoji-container');

    if (hiddenItems.length > 0) {
        allItems.forEach(item => item.classList.remove('hidden'));
        btn.textContent = "- عرض أقل";
        container.classList.add('max-h-[300px]', 'overflow-y-auto');
    } else {
        allItems.forEach((item, index) => {
            if (index >= 16) item.classList.add('hidden');
        });
        btn.textContent = "+ عرض المزيد من الإيموجي";
        container.classList.remove('max-h-[300px]', 'overflow-y-auto');
    }
}

function selectIcon(element, type) {
    const previewBox = document.getElementById('preview-box');

    if (type === 'emoji') {
        // إلغاء ملف الصورة إذا تم اختيار إيموجي
        document.querySelector('input[name="ServiceImage"]').value = "";
        previewBox.innerHTML = element.value;
        previewBox.classList.remove('text-slate-300');
    } else if (type === 'file') {
        // إلغاء اختيار الإيموجي إذا تم رفع صورة
        document.querySelectorAll('input[name="ServiceIcon"]').forEach(input => input.checked = false);

        const file = element.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewBox.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    }
}

function openNurseModal() {
        const modal = document.getElementById('nurseModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeNurseModal() {
        const modal = document.getElementById('nurseModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    function previewImageAdd(input) {
    const preview = document.getElementById('image-preview-add');
    const placeholder = document.getElementById('placeholder-content');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('opacity-0');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  function openPatientModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.style.zIndex = "9999";
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

function previewServiceImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById(previewId);
            img.src = e.target.result;
            img.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

    function showFullImage(src) {
        const lightbox = document.getElementById('imageLightbox');
        const img = document.getElementById('lightboxImg');

        if (lightbox && img) {
            img.src = src;
            lightbox.classList.remove('hidden');

            lightbox.style.zIndex = "10000";
            document.body.style.overflow = 'hidden';
        }
    }
    function previewUpdate(input, imgId, iconId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(imgId).classList.remove('hidden');
            document.getElementById(iconId).classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
 function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.querySelector('img').src = reader.result;
            preview.classList.remove('hidden');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.querySelector('img').src = "";
            preview.classList.add('hidden');
        }
    }




document.querySelectorAll('.star-btn').forEach(star => {
    star.addEventListener('click', function() {
        const container = this.parentElement;
        const rating = this.getAttribute('data-value');
        const nurseId = container.getAttribute('data-nurse-id');
        const stars = container.querySelectorAll('.star-btn');

        stars.forEach(s => {
            if (s.getAttribute('data-value') <= rating) {
                s.classList.replace('far', 'fas');
            } else {
                s.classList.replace('fas', 'far');
            }
        });



    });
});
document.querySelectorAll('.star-rating-container .star-btn').forEach(star => {

    star.addEventListener('mouseover', function() {
        const value = this.getAttribute('data-value');
        const stars = this.parentElement.querySelectorAll('.star-btn');
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.classList.replace('far', 'fas');
            } else {
                s.classList.replace('fas', 'far');
            }
        });
    });

function previewFile(input, imgId, iconId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById(imgId);
            const icon = document.getElementById(iconId);
            img.src = e.target.result;
            img.classList.remove('hidden');
            icon.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}
    star.addEventListener('mouseout', function() {
        const container = this.parentElement;
        const stars = container.querySelectorAll('.star-btn');

    });


    star.addEventListener('click', function() {
        const container = this.parentElement;
        const rating = this.getAttribute('data-value');
        const nurseId = container.getAttribute('data-nurse-id');
        const ratingText = container.parentElement.querySelector('.rating-text');


        if(ratingText) ratingText.innerText = parseFloat(rating).toFixed(2);

        fetch(`/admin/nurses/${nurseId}/rate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ rating: rating })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {

                console.log('تم حفظ التقييم:', rating);
            } else {
                alert('فشل حفظ التقييم: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء الاتصال بالخادم');
        });
    });
});
</script>

@endsection
