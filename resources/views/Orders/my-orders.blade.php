@extends('layouts.layoutHome')

@section('contents')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class="min-h-screen bg-gray-50 w-full py-12 px-4" dir="rtl">
    <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">طلباتي</h2>

    @if($orders->isEmpty())
        <div class="service-card">
            <p class="text-center">لا توجد طلبات حالياً.</p>
        </div>
    @else
        <div class="grid grid-cols-1 w-full md:grid-cols-4 gap-6">
            @foreach($orders as $order)
                <div class="bg-white p-6 rounded-3xl shadow-lg border border-slate-100 hover:shadow-xl transition-all">
                    {{-- رأس المستطيل --}}
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-black text-slate-800">طلب #{{ $order->id }}</h3>
                            <p class="text-sm text-slate-400">{{ $order->created_at->format('Y-m-d') }}</p>
                        </div>
                      @php
    // هذا المتغير يجب أن يكون معرفاً أو يمكنك جلبه من مكان تعريف المصفوفة
    $styles = [
        'Pending'     => ['text' => 'قيد الانتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
        'Accepted'    => ['text' => 'تم القبول', 'class' => 'bg-blue-100 text-blue-800'],
        'In-Progress' => ['text' => 'جاري العمل', 'class' => 'bg-purple-100 text-purple-800'],
        'Completed'   => ['text' => 'مكتمل', 'class' => 'bg-green-100 text-green-800'],
        'Cancelled'   => ['text' => 'ملغي', 'class' => 'bg-red-100 text-red-800'],
        'Cancel'    => ['text' => 'ملغي', 'class' => 'bg-red-100 text-red-800'],
        'Hidden'      => ['text' => 'مخفي', 'class' => 'hidden'],
        'Reject'      => ['text' => 'مرفوض', 'class' => 'bg-gray-100 '], // أضفت حالة الرفض هنا
    ];

    $statusData = $styles[$order->status] ?? ['text' => 'مرفوض ', 'class' => 'bg-gray-100'];
@endphp

{{-- عرض الحالة فقط إذا لم تكن مخفية --}}
@if($order->status !== 'Hidden')
    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $statusData['class'] }}">
        {{ $statusData['text'] }}
    </span>
@endif
                    </div>

                    {{-- تفاصيل الخدمة --}}
                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">الخدمة:</span>
                            <span class="font-bold text-slate-800">{{ $order->service->ServiceName ?? 'غير محدد' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">الإجمالي:</span>
                            <span class="font-bold text-cyan-700">{{ number_format($order->total_price) }} ريال</span>
                        </div>
                    </div>

                    {{-- أزرار التحكم --}}
                    <div x-data="{ openModal{{ $order->id }}: false }" class="grid grid-cols-1 gap-2  mt-4">
                        <a href="{{ route('orders.show', $order->id) }}" class="block w-full text-center py-2 bg-slate-50 hover:bg-cyan-700 hover:text-white rounded-xl font-bold transition-all border border-slate-200 text-xs ">عرض</a>

                   @if($order->status == 'In-Progress' || $order->status == 'Accepted')
    <button @click="openModal{{ $order->id }} = true"
            class="block w-full text-center py-2 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white rounded-xl font-bold transition-all border border-blue-200 text-xs">
        تعديل
    </button>
@endif
<form action="{{ route('Orders.destroy', $order->id) }}" method="POST" class="w-full">
    @csrf
    @method('PATCH') {{-- قمنا بتغييرها من DELETE إلى PATCH --}}

    <input type="hidden" name="action_type" value="{{ $order->status == 'Completed' ? 'delete' : 'cancel' }}">

    <button type="submit"
            onclick="return confirm('{{ $order->status == 'Completed' ? 'هل أنت متأكد من إخفاء هذا السجل؟' : 'هل أنت متأكد من إلغاء الطلب؟' }}')"
            class="block w-full text-center py-2 transition-all border font-bold rounded-xl text-xs
                {{ $order->status == 'Completed'
                    ? 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border-red-200'
                    : 'bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white border-orange-200' }}">

     {{ in_array($order->status, ['Accepted', 'In-Progress']) ? 'إلغاء' : 'إزالة' }}
    </button>
</form>


                        {{-- المودال (داخل الحلقة) --}}
                        <div x-show="openModal{{ $order->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" x-cloak >
                            <div @click.away="openModal{{ $order->id }} = false" class="bg-white p-6 rounded-3xl w-full max-w-lg shadow-2xl">
                                <h1 class="text-2xl font-black text-slate-800 mb-6">تعديل الطلب #{{ $order->id }}</h1>
                                <form action="{{ route('Orders.update', $order->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <label class="block text-sm font-bold text-slate-700 mb-2">تغيير الخدمة</label>
                                    <select name="service_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl mb-4">
                                        @foreach($services as $s)
                                            <option value="{{ $s->ServiceID }}" {{ $order->service_id == $s->ServiceID ? 'selected' : '' }}>{{ $s->ServiceName }}</option>
                                        @endforeach

                                    </select><label class="block text-sm font-bold text-slate-700 mb-4">تغيير الممرض</label>

<div class="swiper nurseSwiper mb-6 ">
    <div class="swiper-wrapper w-1/3">
        @foreach($nurses as $nurse)
            <div class="swiper-slide ">
                <label class="cursor-pointer block">
                    <input type="radio" name="nurse_id" value="{{ $nurse->UserID }}"
                           {{ $order->nurse_id == $nurse->UserID ? 'checked' : '' }}
                           class="hidden peer" required>

                    <div class="p-4 border-2 border-gray-200 rounded-2xl peer-checked:border-cyan-600 peer-checked:bg-cyan-50 transition-all text-center">

      @php
        // محاولة الوصول للجنس مباشرة من علاقة البروفايل
        $gender = $nurse->profile ? $nurse->profile->Gender : 'Unknown';
    @endphp

    {{-- التحقق الآن يعتمد على القيمة التي قرأناها --}}
    @if($gender == 'Male')
        {{-- ذكر --}}
        <img src="{{ asset('storage/' . ($nurse->profile->ProfilePicture ?? 'default.png')) }}"
           class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg mx-auto mb-2">
    @else
        {{-- أنثى أو أي قيمة أخرى --}}
        <img src="https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=FCE7F3&color=DB2777&bold=true"
     class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg mx-auto mb-2">
    @endif
    <span class="absolute w-5 h-5 border-4 border-white rounded-full ring-2 ring-white z-20
    {{ match(strtolower($nurse->Status)) {
        'available' => 'bg-green-500',
        'busy'      => 'bg-red-500',
        'offline'   => 'bg-slate-400',
        default     => 'bg-gray-400',
    } }}"
    style="margin-top: -3ch; margin-left: 200px;">
                    </span>
                        <p class="font-bold text-xs text-slate-800 truncate">{{ $nurse->Username }}</p>
                    </div>
                </label>
            </div>
        @endforeach
    </div>
</div>
                                    <div class="grid grid-cols-2 gap-6 mb-6">
                                        <input type="number" name="patients_count" value="{{ $order->patients_count }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" placeholder="عدد المرضى">
                                        <input type="number" name="service_duration" value="{{ $order->service_duration }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" placeholder="الساعات">
                                    </div>
                                    <div class="flex gap-4">
                                        <button type="submit" class="flex-1 bg-cyan-700 text-white py-4 rounded-2xl font-black text-lg">حفظ التعديلات</button>
                                        <button type="button" @click="openModal{{ $order->id }} = false" class="flex-1 bg-gray-100 text-slate-600 py-4 rounded-2xl font-black text-lg">إلغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<style>  [x-cloak] { display: none !important; }</style>
<script>

    const radioButtons = document.querySelectorAll('input[name="nurse_id"]');
    const submitBtn = document.getElementById('submit-btn');
    const errorMsg = document.getElementById('nurse-error');
const swiper = new Swiper('.nurseSwiper', {
   direction: 'horizontal',
    slidesPerView: 3,     // عدد العناصر الظاهرة عمودياً
    spaceBetween: 1,
    grabCursor: true,
    mousewheel: true,     // اختياري: للسماح بالتمرير بعجلة الماوس
    height: 300,          // ضروري جداً: حدد ارتفاع الحاوية التي سيتم التمرير فيها
});
    radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
            // عند اختيار ممرض، تفعيل الزر وإخفاء التنبيه
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.classList.add('opacity-100');
            errorMsg.classList.add('hidden');
        });
    });

    // منع الإرسال إذا لم يتم الاختيار
    document.querySelector('form').addEventListener('submit', function(e) {
        const selected = document.querySelector('input[name="nurse_id"]:checked');
        if (!selected) {
            e.preventDefault();
            errorMsg.classList.remove('hidden');
            alert('يجب اختيار ممرض أولاً!');
        }
    });

</script>
<style>.nurseSwiper {
    height: 150px; /* أو أي ارتفاع مناسب لتصميمك */
    width: 100%;
}</style>
@endsection
