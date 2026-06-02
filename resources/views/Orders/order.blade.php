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
    <div class="max-w-3xl mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-xl">

        @if(isset($order))
            {{-- حالة عرض تفاصيل الطلب بعد الإرسال --}}
            <h1 class="text-3xl font-black text-cyan-800 mb-6 border-b pb-4">تفاصيل الطلب {{ $order->id }}</h1>
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold border border-yellow-200">
            <span class="w-3 h-3 rounded-full bg-yellow-500 ml-2 animate-pulse"></span>
            حالة الطلب: قيد الانتظار
        </div>
        <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p> {{-- نستخدم شرطاً لتحديد عدد الأعمدة: 1 في الحالة العادية، و 2 إذا كانت رعاية --}}
<div class="grid {{ $order->service->CategoryName== 'رعاية' ? 'grid-cols-3' : 'grid-cols-2' }} gap-4 mb-8">

    {{-- صندوق عدد المرضى --}}
    <div class="p-4 bg-gray-50 rounded-xl">
        <p class="text-xs text-gray-500">عدد المرضى</p>
        <p class="font-bold text-xl">{{ $order->patients_count }}</p>
    </div>

    {{-- صندوق مدة الخدمة (يظهر فقط للرعاية) --}}
    @if($order->service->CategoryName == 'رعاية')
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-xs text-gray-500">مدة الخدمة</p>
            <p class="font-bold text-xl">{{ $order->service_duration }} ساعة</p>
        </div>
    @endif

    {{-- صندوق الإجمالي --}}
    <div class="p-4 bg-cyan-100 rounded-xl">
        <p class="text-xs text-cyan-700">إجمالي السعر</p>
        <p class="font-bold text-xl text-cyan-900">{{ number_format($order->total_price) }} ريال</p>
    </div>
</div>
@if(isset($order))
    <div id="nurse-details" class="bg-cyan-50 p-6 rounded-2xl border border-cyan-100 mt-6">
        <h2 class="text-lg font-bold text-cyan-900 mb-4">بيانات الممرض المختار</h2>
        <div class="flex items-center gap-4">
            <img src="{{ asset('storage/' . ($order->nurse->profile->ProfilePicture ?? 'default.png')) }}"
                 class="w-12 h-12 rounded-full object-cover">
            <div>
                <p><strong>اسم الممرض:</strong> {{ $order->nurse->Username }}</p>
                <p><strong>التخصص:</strong> {{ $order->nurse->profile->Specialization ?? 'غير محدد' }}</p>
            </div>
        </div>
    </div>
@endif
<p class="text-center text-sm font-bold text-cyan-800 mb-5"></p>
            <div id="patient-details" class="bg-cyan-50 p-6 rounded-2xl border border-cyan-100">
                <h2 class="text-lg font-bold text-cyan-900 mb-4">بيانات المريض</h2>
                <p><strong>الاسم:</strong> {{ $patientData['name'] }}</p>
                <p><strong>رقم التواصل:</strong> {{ $patientData['phone'] }}</p>
                <p><strong>العنوان:</strong> {{ $patientData['address'] }}</p>
            </div>
            <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
            <a href="{{ route('orders.my-orders') }}"
       class="block w-full text-center bg-slate-800 text-white py-4 rounded-2xl font-bold hover:bg-slate-900 transition-all">
        الانتقال إلى قائمة طلباتي
    </a>
        @else
            {{-- حالة تقديم طلب جديد --}}
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

<div class="swiper nurseSwiper mb-6 w-full">
    <div class="swiper-wrapper">
        @foreach($nurses as $nurse)
            <div class="swiper-slide w-1/3"> <label class="cursor-pointer block">
                    <input type="radio" name="nurse_id" value="{{ $nurse->UserID }}" class="hidden peer" required>
                    <div class="p-4 border-2 border-gray-200 rounded-2xl peer-checked:border-cyan-600 peer-checked:bg-cyan-50 transition-all text-center">
                        <img src="{{ asset('storage/' . ($nurse->profile->ProfilePicture ?? 'default.png')) }}"
                             class="w-12 h-12 rounded-full mx-auto mb-2 object-cover">
                        <p class="font-bold text-xs text-slate-800">{{ $nurse->Username }}</p>
                    </div>
                </label>
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
        slidesPerView: 3, // عرض 3 ممرضين في المرة الواحدة
        spaceBetween: 10,
        grabCursor: true,
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
@endsection
