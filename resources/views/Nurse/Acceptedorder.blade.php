@extends('layouts.layoutnurse')

@section('contents')
<p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class=" bg-gray-50 w-full py-12 px-4" dir="rtl">
    <h2 class="text-center text-2xl font-bold text-cyan-800 mb-12">الطلبات المقبولة </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($orders as $order)
            <div class="bg-white p-6 rounded-3xl shadow-lg border border-slate-100 hover:shadow-xl transition-all">

                {{-- رأس البطاقة --}}
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">طلب #{{ $order->id }}</h3>
                        <p class="text-sm text-slate-400">{{ $order->created_at->format('Y-m-d') }}</p>
                    </div>
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">
                        جاري العمل
                    </span>
                </div>

                {{-- التفاصيل --}}
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">المريض:</span>
                        <span class="font-bold text-slate-800">
                            {{ json_decode($order->review, true)['name'] ?? ($order->user->Username ?? 'غير معروف') }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">الخدمة:</span>
                        <span class="font-bold text-slate-800">{{ $order->service->ServiceName ?? 'غير محدد' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">الإجمالي:</span>
                        <span class="font-bold text-cyan-700">{{ number_format($order->total_price) }} ريال</span>
                    </div>
                </div>

                {{-- زر الإجراء --}}
               <form action="{{ route('orders.complete', $order->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من إتمام هذا الطلب؟');">
    @csrf
    @method('PATCH')

    <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-2xl font-bold hover:bg-emerald-700 transition-all shadow-lg active:scale-95">
        تم اكتمال الطلب
    </button>
</form>
            </div>
        @empty
            <div class="col-span-full bg-white p-10 rounded-3xl shadow-sm text-center border border-slate-100">
                <p class="text-slate-500 text-lg">لا توجد طلبات مقبولة حالياً.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
