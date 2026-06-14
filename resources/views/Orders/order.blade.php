@extends('layouts.layoutHome')

@section('contents')


@if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-xl mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div class="min-h-screen bg-gray-50 py-12 px-4" dir="rtl">
    <div class="max-w-xl mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-xl">

        @if(isset($order))
            {{-- حالة عرض تفاصيل الطلب بعد الإرسال --}}
            <h1 class="text-3xl max-w-7xl font-black text-cyan-800 mb-6 border-b pb-4">تفاصيل الطلب {{ $order->id }}</h1>
          <div class="inline-flex items-center px-41 py-26 rounded-full bg-yellow-100 text-yellow-800 font-bold border border-yellow-200">
                                      @php
    // هذا المتغير يجب أن يكون معرفاً أو يمكنك جلبه من مكان تعريف المصفوفة
    $styles = [
        'Pending'     => ['text' => 'قيد الانتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
        'Accepted'    => ['text' => 'تم القبول', 'class' => 'bg-blue-100 text-blue-800'],
        'In-Progress' => ['text' => 'جاري العمل', 'class' => 'bg-purple-100 text-purple-800'],
        'Completed'   => ['text' => 'مكتمل', 'class' => 'bg-green-100 text-green-800'],
        'Cancelled'   => ['text' => 'ملغي', 'class' => 'bg-red-100 text-red-800'],
        'Hidden'      => ['text' => 'مخفي', 'class' => 'hidden'],
        'Reject'      => ['text' => 'مرفوض', 'class' => 'bg-gray-100 '], // أضفت حالة الرفض هنا
    ];

    $statusData = $styles[$order->status] ?? ['text' => 'مرفوض ', 'class' => 'bg-gray-100'];
@endphp
@if($order->status !== 'Hidden')
    <span class="px-2 py-1 rounded-full text-xl font-bold {{ $statusData['class'] }}">
        {{ $statusData['text'] }}
    </span>
@endif

        </div>
        <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p> {{-- نستخدم شرطاً لتحديد عدد الأعمدة: 1 في الحالة العادية، و 2 إذا كانت رعاية --}}
<div class="grid {{ $order->service->CategoryName== 'رعاية' ? 'grid-cols-3' : 'grid-cols-2' }} gap-4 mb-8">

    {{-- صندوق عدد المرضى --}}
    <div class="p-4 bg-cyan-50  rounded-xl">
        <p class="text-xs text-gray-500 ">عدد المرضى</p>
        <p class="font-bold text-xl">{{ $order->patients_count }}</p>
    </div>

    {{-- صندوق مدة الخدمة (يظهر فقط للرعاية) --}}
    @if($order->service->CategoryName == 'رعاية')
        <div class="p-4 bg-cyan-50 rounded-xl">
            <p class="text-xs text-cyan-800">مدة الخدمة</p>
            <p class="font-bold text-xl">{{ $order->service_duration }} ساعة</p>
        </div>
    @endif

    {{-- صندوق الإجمالي --}}
    <div class="p-4 bg-cyan-800 rounded-xl">
        <p class="text-xs text-white">إجمالي السعر</p>
        <p class="font-bold text-xl text-white">{{ number_format($order->total_price) }} ريال</p>
    </div>
</div>
@if(isset($order))
 <div  class="bg-blue-50 p-6 rounded-3xl   border border-slate-100 shadow-sm">
    <h2 class="text-xl font-black text-cyan-950 mb-6 flex items-center gap-2 ">
        <i class="fa-solid fa-user-nurse text-cyan-600"></i> بيانات الممرض المختار
            </h2>
  @php
        $nurse = $order->nurse;
        $profile = $nurse->profile;
        $hasImage = $profile && $profile->ProfilePicture;
        $gender = $profile->Gender ?? 'Unknown';
    @endphp

 <a href="{{ route('nurse.profile', $nurse->UserID) }}" >

     <div class="flex items-center  gap-4 p-4 bg-white rounded-full border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-300">


    <div class="relative">
        <img src="{{ $hasImage ? asset('storage/' . $profile->ProfilePicture) : 'https://ui-avatars.com/api/?name='.urlencode($nurse->Username).'&background='.($gender == 'Female' ? 'FCE7F3' : 'EBF4FF').'&color='.($gender == 'Female' ? 'DB2777' : '1E40AF').'&bold=true' }}"
             class="w-16 h-16 rounded-full object-cover border-2 border-slate-50 shadow-inner"
             alt="{{ $nurse->Username }}">
        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
    </div>

    <div class="flex flex-col gap-1">
        <h3 class="font-black text-cyan-950 text-base leading-tight">
            {{ $nurse->Username }}
        </h3>
        <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded-lg bg-cyan-50 text-[10px] font-black text-cyan-700 uppercase tracking-wider">
                {{ $profile->Specialization ?? 'ممرض عام' }}
            </span>
        </div>

    </div>

</div>

 </a>
</div>
@endif
<p class="text-center text-sm font-bold text-cyan-800 mb-5"></p>
          <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
    <h2 class="text-xl font-black text-cyan-950 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-user-injured text-cyan-600"></i> بيانات المريض
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-user "></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400 tracking-wider">الاسم</span>
                <span class="text-sm font-bold text-slate-800">{{ $patientData['name'] }}</span>
            </div>
        </div>

        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400 tracking-wider">رقم التواصل</span>
                <span class="text-sm font-bold text-slate-800 tabular-nums" dir="ltr">{{ $patientData['phone'] }}</span>
            </div>
        </div>

        <div class="flex items-start gap-3 md:col-span-2">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400 tracking-wider">العنوان</span>
                <span class="text-sm font-bold text-slate-800">{{ $patientData['address'] }}</span>
            </div>
        </div>
    </div>
</div>
            <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
            <a href="{{ route('orders.my-orders') }}"
       class="block w-full text-center bg-slate-800 text-white py-4 rounded-2xl font-bold hover:bg-slate-900 transition-all">
        الانتقال إلى قائمة طلباتي
    </a>
        @else

            <form action="{{ route('orders.store') }}" method="POST" onsubmit="return confirm('هل أنت متأكد من بيانات الطلب والممرض المختار؟');">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->ServiceID }}">
                <h1 class="text-2xl font-black text-slate-800 mb-6">طلب خدمة: {{ $service->ServiceName }}</h1>

           {{-- نتحقق من نوع الخدمة لنحدد عدد الأعمدة --}}
<div class="grid grid-cols-1 {{ $service->CategoryName == 'رعاية' ? 'md:grid-cols-2' : '' }} gap-6 mb-6">

    {{-- حقل عدد المرضى (سيأخذ العرض الكامل إذا كانت تمريض، ونصفه إذا كانت رعاية) --}}
    <div class="{{ $service->CategoryName != 'رعاية' ? 'md:col-span-2' : '' }}">
        <label class="block text-sm font-bold text-slate-700 mb-2">عدد المرضى</label>
        <input type="number" name="patients_count" value="1" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none" required>
    </div>

    @if($service->CategoryName == 'رعاية')
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">مدة الخدمة (ساعات)</label>
            <input type="number" name="service_duration" placeholder="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none" required>
        </div>
    @else
        <input type="hidden" name="service_duration" value="1">
    @endif

</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<h3 class="text-sm font-bold text-slate-700 mb-4 mt-6">اختر الممرض المتاح:</h3>

<div class="swiper nurseSwiper ">
    <div class="swiper-wrapper">
        @foreach($nurses as $nurse)
            <div class="swiper-slide w-1/3"><div class="grid grid-cols-1 "> <label class="cursor-pointer block">
                    <input type="radio" name="nurse_id" value="{{ $nurse->UserID }}" class="hidden peer" required>
                    <div class="p-4 border-2 border-gray-200 rounded-2xl  items-center peer-checked:border-cyan-600 peer-checked:bg-cyan-50 transition-all text-center">

      @php

        $gender = $nurse->profile ? $nurse->profile->Gender : 'Unknown';
    @endphp

    @if($gender == 'Male')

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
                        <p class="font-bold text-xs text-slate-800">{{ $nurse->Username }}</p>
                    </div>
                </label>
            </div>
            </div>
        @endforeach
    </div>
</div>
                {{-- رابط تفعيل حقول المستفيد الآخر --}}
                <button type="button" onclick="document.getElementById('other-patient-fields').classList.toggle('hidden')"
                        class="text-cyan-700 font-bold text-sm mb-6 underline">
                    + طلب الخدمة لشخص آخر (أدخل بيانات المريض)
                </button>

                {{-- حقول المستفيد الآخر (مخفية) --}}
                <div id="other-patient-fields" class="hidden space-y-4 mb-6 p-6 border border-cyan-100 rounded-2xl bg-cyan-50/50">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">اسم المريض</label>
                        <input type="text" name="custom_patient_name" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">رقم الجوال</label>
                            <input type="tel" name="custom_patient_phone" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">العنوان</label>
                            <input type="text" name="custom_patient_address" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none">
                        </div>
                    </div>
                </div>
@csrf
              <div id="nurse-error" class="hidden text-red-600 font-bold text-sm mb-4 text-center">
    ⚠️ يرجى اختيار ممرض من القائمة أعلاه للمتابعة
</div>

<button type="submit" id="submit-btn"
        class="w-full mt-4 bg-cyan-700 text-white py-4 rounded-2xl font-black text-xl hover:bg-cyan-800 transition-all opacity-50 cursor-not-allowed">
    تأكيد الطلب
</button>
            </form>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
