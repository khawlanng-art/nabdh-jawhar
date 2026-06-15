@extends('layouts.layoutnurse')

@section('contents')
<div class="max-w-4xl mx-auto p-6 mt-10">
   <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">التقييمات</h2>

  <div class="grid gap-4">
    @forelse($reviews as $order)
        @php
            $data = json_decode($order->review, true);
            $isJson = (json_last_error() === JSON_ERROR_NONE && is_array($data));
        @endphp

        <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:border-cyan-100 transition-all duration-300">
            <div class="flex justify-between items-center">

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-600">
                        <i class="fa-solid fa-user text-xl"></i>
                    </div>

                    <div class="flex flex-col gap-0.5">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                            طلب رقم #{{ $order->id }}
                        </p>
                        <h3 class="font-black text-slate-800 text-base">
                            {{ $isJson ? ($data['name'] ?? 'مريض') : $order->user->Username }}
                        </h3>
                    </div>
                    <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
                </div>

                <div class="flex flex-shrink-0 items-center justify-center gap-1.5 bg-yellow-50 border border-yellow-100 w-16 h-12 rounded-2xl ml-6">
                    <i class="fa-solid fa-star text-yellow-400 text-sm"></i>
                    <span class="text-yellow-700 font-black text-base">{{ $order->rating ?? '0.0' }}</span>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-slate-400 py-10">لا توجد مراجعات حالياً</p>
    @endforelse
</div>


</div>
@endsection
