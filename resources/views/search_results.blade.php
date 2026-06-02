@extends('layouts.layoutHome')

@section('contents')

    <div class="container mx-auto py-10">
    <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">نتائج البحث عن "{{ $query }}"</h2>

    @if($nurses->isNotEmpty())
        <h2 class="text-xl font-semibold mb-4 text-cyan-800">الممرضون</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            @foreach($nurses as $nurse)
                <a href="{{ route('Nurse.nurses', $nurse->id) }}" id="nurse-{{ $nurse->id }}" class="block p-4 border rounded-lg shadow-sm hover:bg-cyan-50 transition">
                    <h3 class="font-bold">{{ $nurse->Username }}</h3>
                </a>
            @endforeach
        </div>
    @endif

    @if($services->isNotEmpty())
        <h2 class="text-xl font-semibold mb-4 text-cyan-800">الخدمات</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            @foreach($services as $service)
                <a href="{{ route('Services.Services', $service->id) }}" id="service-{{ $service->id }}" class="block p-4 border rounded-lg shadow-sm hover:bg-cyan-50 transition">
                    <h3 class="font-bold">{{ $service->ServiceName }}</h3>
                </a>
            @endforeach
        </div>
    @endif

    @if($orders->isNotEmpty())
        <h2 class="text-xl font-semibold mb-4 text-cyan-800">الطلبات</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            @foreach($orders as $order)
                <a href="{{ route('Services.Services', $order->id) }}" id="order-{{ $order->id }}" class="block p-4 border rounded-lg shadow-sm hover:bg-cyan-50 transition">
                    <h3 class="font-bold">طلب رقم: {{ $order->id }}</h3>
                    <p class="text-sm text-gray-600">الحالة: {{ $order->status }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>

    @if($nurses->isEmpty() && $services->isEmpty() && $orders->isEmpty())
        <p class="text-gray-500">للأسف، لم نجد نتائج تطابق بحثك.</p>
    @endif
</div>

@endsection
