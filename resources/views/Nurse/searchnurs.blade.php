@extends('layouts.layoutnurse')

@section('contents')
<div class="container mx-auto py-10 px-6" dir="rtl">
    <h2 class="text-center text-2xl font-bold text-cyan-600 mb-2">نتائج البحث عن:</h2>
    <p class="text-center text-2xl font-black text-cyan-900 mb-12">"{{ request('nurse_search_filter') }}"</p>

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 mb-6">
            <div class="w-1.5 h-6 bg-cyan-500 rounded-full"></div>
            <span class="text-xl font-black text-slate-800">الطلبات</span>

        </div>

        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="bg-white w-full p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-cyan-400 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center font-bold">
                            طـ
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">طلب #{{ $order->id }}</h3>
                            <p class="text-xs text-slate-500">الخدمة: {{ $order->service->ServiceName ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                     <div>
                         <p class="text-black text-xs font-black">الاجمالي</p>

                        <p class="text-cyan-700 font-black">{{ number_format($order->total_price) }} ريال</p>

                    </div>
  <div class="header-left notification-wrapper relative"
     x-data="{
         showNotifications: false,
         showActionModal: false,
         showDetailsModal: false,   selectedOrder: {},         openAction(id) {
             this.showActionModal = true;
             this.showNotifications = false;
         }
     }">



    @foreach($orders as $order)
    <button class="bg-slate-200 text-black w-full py-2 mt-3 rounded-xl"
            @click="showDetailsModal = true; selectedOrder = {{ json_encode($order) }}">
        عرض التفاصيل
    </button>
@endforeach
<template x-teleport="body">
    <div x-show="showDetailsModal"
         x-cloak
         class="fixed inset-0  overflow-y-auto z-[999999] flex items-center justify-center p-4 bg-black/50 backdrop-blur-md"
         @click.away="showDetailsModal = false">

         <div @click.stop>
             <h2 class="text-xl font-bold mb-4">تفاصيل الطلب رقم #<span x-text="selectedOrder"></span></h2>

             <div class="max-w-m mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-xl">

        @if(isset($order))

            <h1 class="text-3xl font-black text-cyan-800 mb-6 border-b pb-4">تفاصيل الطلب #{{ $order->id }}</h1>

            <div class="mb-8">
                  @php
                            $styles = [
                                'Pending'     => ['text' => 'قيد الانتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
                                'Accepted'    => ['text' => 'تم القبول', 'class' => 'bg-blue-100 text-blue-800'],
                                'In-Progress' => ['text' => 'جاري العمل', 'class' => 'bg-purple-100 text-purple-800'],
                                'Completed'   => ['text' => 'مكتمل', 'class' => 'bg-green-100 text-green-800'],
                                'Cancelled'   => ['text' => 'ملغي', 'class' => 'bg-red-100 text-red-800'],
                                'Reject'      => ['text' => 'مرفوض', 'class' => 'bg-gray-200 text-gray-800'],
                            ];
                            $statusData = $styles[$order->status] ?? ['text' => $order->status, 'class' => 'bg-gray-100'];
                        @endphp

                        @if($order->status !== 'Hidden')
                            <span class="px-2 py-1 rounded-full text-xl font-bold {{ $statusData['class'] }}">
                                {{ $statusData['text'] }}
                            </span>
                        @endif
            </div>

            <div class="grid {{ $order->service->CategoryName == 'رعاية' ? 'grid-cols-3' : 'grid-cols-2' }} gap-4 mb-8">
                <div class="p-4 bg-cyan-50 rounded-xl">
                    <p class="text-xs text-gray-500">عدد المرضى</p>
                    <p class="font-bold text-xl">{{ $order->patients_count }}</p>
                </div>

                @if($order->service->CategoryName == 'رعاية')
                    <div class="p-4 bg-cyan-50 rounded-xl">
                        <p class="text-xs text-cyan-800">مدة الخدمة</p>
                        <p class="font-bold text-xl">{{ $order->service_duration }} ساعة</p>
                    </div>
                @endif

                <div class="p-4 bg-cyan-800 rounded-xl">
                    <p class="text-xs text-white">إجمالي السعر</p>
                    <p class="font-bold text-xl text-white">{{ number_format($order->total_price) }} ريال</p>
                </div>
            </div>



           <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-8">
    <h2 class="text-xl font-black text-cyan-950 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-user-injured text-cyan-600"></i> بيانات المريض والخدمة
    </h2>

    @php
        $pData = !empty($order->review) ? json_decode($order->review, true) : [];
        $displayName = !empty($pData['name']) ? $pData['name'] : ($order->user->Username ?? 'غير معروف');
        $displayPhone = !empty($pData['phone']) ? $pData['phone'] : ($order->user->Phone ?? 'لا يوجد');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- عرض اسم الخدمة --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-stethoscope"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">الخدمة المطلوبة</span>
                <span class="text-sm font-bold text-slate-800">{{ $order->service->ServiceName ?? 'غير محدد' }}</span>
            </div>
        </div>

        {{-- عرض الاسم --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">اسم المريض</span>
                <span class="text-sm font-bold text-slate-800">{{ $displayName }}</span>
            </div>
        </div>

        {{-- عرض الهاتف --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">رقم التواصل</span>
                <span class="text-sm font-bold text-slate-800 tabular-nums" dir="ltr">{{ $displayPhone }}</span>
            </div>
             @endif
        </div>
    </div>
</div>


             <button @click="showDetailsModal = false" class="w-full mt-6 bg-slate-800 text-white py-3 rounded-2xl">
                 إغلاق التفاصيل
             </button>
         </div>
    </div>
</template>


       </div>

                </div>
            @empty
                <div class="bg-white p-8 rounded-xl border border-slate-200 text-center text-slate-400">
                    لا توجد طلبات تطابق بحثك الحالي.
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        {{ $orders->appends(['nurse_search_filter' => request('nurse_search_filter')])->links() }}
    </div>
</div>
@endsection
