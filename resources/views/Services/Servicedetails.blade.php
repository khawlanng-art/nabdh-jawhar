@extends('layouts.layoutHome')

@section('contents')

<p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class="max-w-7xl mx-auto py-16 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

        <div class="flex justify-center md:justify-start">
            @if($service->IconURL)
                @if(Str::contains($service->IconURL, ['services/', '/', '.']))
                    <img src="{{ Storage::url($service->IconURL) }}" alt="{{ $service->ServiceName }}"
                         class="w-full max-w-md h-96 object-cover rounded-3xl shadow-lg border border-slate-100">
                @else
                    <span class="w-40 h-40 bg-cyan-50 rounded-full text-cyan-800 flex items-center justify-center text-6xl border-4 border-cyan-100 shadow-inner">
                        {{ $service->IconURL }}
                    </span>
                @endif
            @else
                <div class="w-full max-w-md h-96 flex items-center justify-center bg-slate-50 rounded-3xl border border-slate-100">
                    <i class="fa-solid fa-stethoscope text-cyan-600 text-9xl"></i>
                </div>
            @endif
        </div>

        <div class="about-text-wrapper">
            <span class="bg-cyan-100 text-cyan-800 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                {{ $service->CategoryName }}
            </span>

            <h1 class="text-4xl font-black text-slate-900 mt-4 mb-6">
                {{ $service->ServiceName }}
            </h1>

            <div class="prose prose-lg text-slate-600 text-justify mb-8">
                <p>{{ $service->Description }}</p>
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-8">
                <span class="text-slate-500 font-medium">
                    السعر ({{ $service->CategoryName == 'رعاية' ? 'للساعة الواحدة' : 'للشخص الواحد' }})
                </span>
                <div class="text-4xl font-black text-amber-600 mt-1">
                    {{ number_format($service->BasePrice, 0) }} <span class="text-xl text-slate-400">ر.ي</span>
                </div>
            </div>

            <div class="space-y-3 mb-8">
                <p class="text-emerald-700 text-sm font-bold"><i class="fa-solid fa-circle-check"></i> الأسعار تشمل الأدوات الطبية.</p>
                <p class="text-rose-600 text-sm font-bold"><i class="fa-solid fa-circle-xmark"></i> الأسعار لا تشمل المواصلات.</p>
            </div>


        </div>
    </div>
  <div class="flex justify-center mt-10">
     <a href="{{ auth()->check() ? route('Orders.order', $service->ServiceID) : route('login') }}"
        class="w-full md:w-1/2 text-center py-4 bg-cyan-700 text-white text-xl font-bold rounded-xl hover:bg-cyan-800 transition-all shadow-lg hover:shadow-xl">
        طلب الخدمة الآن
     </a>
</div>
</div>
@endsection
