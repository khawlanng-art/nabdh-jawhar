@extends('layouts.layoutHome')

@section('contents')
<p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class="container mx-auto py-12 px-4 max-w-7xl">

    <div class="mb-10 text-center">
        <h2 class="text-2xl font-extrabold text-cyan-600">نتائج البحث عن:</h2>
        <p class="text-slate-500 mt-2"><span class="font-bold text-xl text-cyan-900">"{{ $searchQuery }}"</span></p>
    </div>

    <div class="space-y-8">

        {{-- الممرضون --}}
        @if($nurses->isNotEmpty())
        <section>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-1.5 h-6 bg-cyan-500 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">الممرضون</h2>
            </div>
            <div class="flex flex-col gap-2 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($nurses as $nurse)
                <a href="{{ route('Nurse.nurses', $nurse->id) }}"
                   class="flex items-center gap-4 p-3 bg-white border border-slate-100 rounded-xl hover:bg-cyan-50 transition-all shadow-sm">
                    <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center text-sm text-cyan-600 font-bold">
                        {{ mb_substr($nurse->Username, 0, 1) }}
                    </div>
                    <span class="font-semibold text-slate-700">{{ $nurse->Username }}</span>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- الخدمات --}}
        @if($services->isNotEmpty())
        <section>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-1.5 h-6 bg-orange-500 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">الخدمات الطبية</h2>
            </div>
            <div class="flex flex-col gap-2 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($services as $service)
                <a href="{{ route('Services.Services', $service->id) }}"
                   class="flex items-center gap-4 p-3 bg-white border border-slate-100 rounded-xl hover:bg-orange-50 transition-all shadow-sm">
                    <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">🛠</div>
                    <span class="font-semibold text-slate-700">{{ $service->ServiceName }}</span>
                </a>
                @endforeach
            </div>
        </section>
        @endif
@auth


        {{-- الطلبات --}}
        @if($orders->isNotEmpty())
        <section>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">الطلبات</h2>
            </div>
            <div class="flex flex-col gap-2 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($orders as $order)
                <a href="{{ route('Services.Services', $order->id) }}"
                   class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-xl hover:bg-emerald-50 transition-all shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">📋</div>
                        <span class="font-semibold text-slate-700">طلب رقم #{{ $order->id }}</span>
                    </div>
                    <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full font-bold">{{ $order->status }}</span>
                </a>
                @endforeach
            </div>
        </section>
        @endif
@endauth
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
@endsection
