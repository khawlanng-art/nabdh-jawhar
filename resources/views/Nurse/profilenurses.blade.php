@extends('layouts.layoutHome')

@section('contents')
  <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class="max-w-6xl mx-auto py-16 px-6 " >

<style>
/* إعداد الصفحة الأساسي */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}
footer { display: none !important; }
/* طبقة الخلفية (الصورة المشوشة والمعتمة) */
body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('images6.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    /* التشويش (Blur) */
    filter: blur(3px);
    /* التعتيم (Overlay) */
    background-color: rgba(0, 0, 0, 0.2);
    background-blend-mode: darken;
    z-index: -1;
    /* لجعل الصورة تغطي المساحات الإضافية الناتجة عن الـ blur */
    transform: scale(1.1);
}
h1, p {
    text-shadow: 0 6px 6px white;
}

    /* البطاقة الجانبية: ممتدة للأسفل وشفافة - تم تعديل الزوايا لليمين */
    .side-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        /* زوايا دائرية من جهة اليمين لتلتصق بالجانب الأيسر */
        border-top-right-radius: 4rem;
        border-bottom-right-radius: 4rem;
        height: 100vh;
        display: flex;
        align-items: center;
        border-right: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<div class="flex flex-row-reverse min-h-screen w-full ">

    <div class="justify-center items-left w-full">

<div class="mt-4 p-3 border-4 border-white/50 rounded-full shadow-[0_0_60px_rgba(34,211,238,0.4)] inline-block">

@php
        // محاولة الوصول للجنس مباشرة من علاقة البروفايل
        $gender = $nurse->profile ? $nurse->profile->Gender : 'Unknown';
    @endphp

    {{-- التحقق الآن يعتمد على القيمة التي قرأناها --}}
    @if($gender == 'Male')
    <img src="{{ asset('storage/' . $nurse->profile->ProfilePicture) }}"
         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=EBF4FF&color=1E40AF&bold=true'"
         class="w-[600px] h-[400px] rounded-full object-cover border-4 border-cyan-100">
          @else
        {{-- أنثى أو أي قيمة أخرى --}}
        <img src="https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=FCE7F3&color=DB2777&bold=true"
             class="w-[600px] h-[400px] rounded-full object-cover border-4 border-white shadow-lg">
    @endif
           <span class="absolute w-16 h-16 border-4 border-white rounded-full ring-2 ring-white z-20
    {{ match(strtolower($nurse->Status)) {
        'available' => 'bg-green-500',
        'busy'      => 'bg-red-500',
        'offline'   => 'bg-slate-400',
        default     => 'bg-gray-400',
    } }}"
    style=" margin-left: 200px; top: 20%;">
    </span>

</div>

    </div>
 <p class="text-center p-14 text-3xl font-bold text-cyan-800 mb-12"></p>

        <div class="text-right w-full">
  <h1 class="text-2xl font-extrabold text-cyan-950 mb-4">{{ $nurse->Username }}</h1>
 <p class="text-2xl text-cyan-700 font-bold mb-12 border-b-2 border-cyan-400 pb-6"> {{ $nurse->profile->Specialization }}
 </p>

            <div class="space-y-8">
                <div class="bg-white/50 p-6 rounded-3xl border border-white/50">
                    <span class="block text-xs text-cyan-700 font-black uppercase mb-2">البريد الإلكتروني</span>
                    <span class="font-bold text-gray-900 text-xl">{{ $nurse->email }}</span>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/50 p-6 rounded-3xl border border-white/50">
                        <span class="block text-xs text-gray-500 font-black uppercase mb-2">رقم الهاتف</span>
                        <span class="font-bold text-gray-900 text-lg" dir="ltr">{{ $nurse->profile->PhoneNumber }}</span>
                    </div>

                    <div class="bg-white/50 p-6 rounded-3xl border border-white/50">
                        <span class="block text-xs text-gray-500 font-black uppercase mb-2">التقييم</span>
                        @php
        // نحسب متوسط التقييم للطلبات الخاصة بهذا الممرض
        $avg = $nurse->orders->avg('rating') ?? 0;
    @endphp
                        <span class="font-bold text-yellow-600 text-2xl">★  {{ number_format($avg, 1) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
