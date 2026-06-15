@extends('layouts.layoutHome')

@section('contents')
<div class="max-w-7xl mx-auto py-16 px-6 space-y-24">

    <section id="about" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="overflow-hidden rounded-3xl shadow-2xl">
            <img src="{{ asset('images2.png') }}" alt="فريق العمل" class="w-full h-full object-cover  hover:scale-105 transition-transform duration-500">
        </div>
        <div class="space-y-6">
            <h2 class="text-4xl font-black text-cyan-900 border-r-8 border-cyan-700 pr-4">من نحن</h2>
            <p class="text-lg text-slate-600 leading-relaxed text-justify">
                نبض جوار هو من أفضل المنصات الإلكترونية لتقديم خدمة الرعاية الصحية والطبية في المنزل بدون تعب النزول والانتظار في العيادات. كما يقدم نبض جوار نقلة نوعية جديدة في مجال الرعاية الصحية. من المعتاد أن يبذل طالب الرعاية الصحية مجهوداً كبيراً حتى يصل إلى توفير خدمة مناسبة وقيمة، بينما يوفر نبض جوار لجميع الخدمات الطبية والمنزلية الأمر بسهولة، حيث تضمن لك الرعاية لحد باب البيت.
            </p>
        </div>
    </section>

    <section id="Ourvision" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 order-2 md:order-1">
            <h2 class="text-4xl font-black text-cyan-900 border-l-8 border-amber-500 pl-4">رؤيتنا</h2>
            <p class="text-lg text-slate-600 leading-relaxed text-justify">
                نبض جوار المكان الأول لخدمات التمريض المنزلي في المكلا، وهو ما يدفعنا للتوسع والتطور. حيث نسعى إلى الخروج من المستوى المحلي لتوفير خدماتنا بجميع مناطق محافظة حضرموت. كما نقدم خدماتنا عن طريق تمريض متخصص ومُدرب على أعلى مستوى وبإستخدام أحدث التكنولوجيا والتقنيات العالمية لضمان أعلى جودة، لنصبح الاختيار الأول والأمثل في مجال التمريض المنزلي.
            </p>
        </div>
        <div class="overflow-hidden rounded-3xl shadow-2xl order-1 md:order-2">
            <img src="{{ asset('images1.png') }}" alt="رؤيتنا" class="w-full h-full object-cover  hover:scale-105 transition-transform duration-500">
        </div>
    </section>

</div>


<div id="services" class="services-section py-16 px-4 bg-gray-100%">
    <div class="max-w-7xl mx-auto ">

        <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">خدماتنا </h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-20 justify-items-center">
        @foreach($services as $service)
        <div class="w-72 flex flex-col h-full group overflow-hidden rounded-lg border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-lg">

    <div class="overflow-hidden h-40 flex items-center justify-center bg-gray-10">
            @if($service->IconURL)
                @if(Str::contains($service->IconURL, ['services/', '/', '.']))
                    <img src="{{ url('storage/' . $service->IconURL) }}"
                         alt="{{ $service->ServiceName }}"
                         class="w-full h-full object-cover shadow-sm">
                @else
                    <span class="text-2xl">{{ $service->IconURL }}</span>
                @endif
            @else
                <i class="fa-solid fa-stethoscope text-blue-500 text-4xl"></i>
            @endif
        </div>

        <div class="p-4 flex flex-col flex-grow bg-slate-200">
        <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $service->ServiceName }}</h3>
        <p class="text-slate-600 text-xs mb-4 line-clamp-3">{{ $service->Description }}</p>

        <div class="mt-auto">
            <a href="{{ route('Services.Servicedetails', $service->ServiceID) }}"
               class="block w-full text-center py-2 bg-slate-50 text-slate-700 text-sm font-semibold hover:bg-cyan-700 hover:text-white transition-colors rounded">
                عرض الخدمة
            </a>
        </div>
    </div>
</div>
    @endforeach

</div>
 @forelse($services as $service)
        <div class="service-card">{{ $service->name }}</div>
    @empty
        <p class="text-center">عذراً، لا توجد خدمات متاحة حالياً.</p>
    @endforelse
<div class="text-center mt-12">
            <a href="{{ route('Services.Services') }}"
               class="inline-block px-8 py-3 bg-cyan-800 text-white font-bold rounded-full hover:bg-cyan-900 transition-all shadow-lg">
                المزيد من الخدمات
            </a>

        </div>
    </div>

</div>
<div id="nurse" class="max-w-7xl mx-auto py-16 px-6 space-y-24">
    <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">الممرضون المميزون</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-20 justify-items-center">
    @foreach($nurses as $nurse)
        {{-- ربط الكرت بالكامل بصفحة البروفايل --}}
        <a href="{{ route('nurse.profile', $nurse->UserID) }}" class="group block w-80">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 overflow-hidden">

                {{-- الصورة مع دائرة الحالة --}}
                <div class="pt-8 pb-4 flex justify-center ">
                 <div class=" inline-block">
   @php
        // محاولة الوصول للجنس مباشرة من علاقة البروفايل
        $gender = $nurse->profile ? $nurse->profile->Gender : 'Unknown';
    @endphp

    {{-- التحقق الآن يعتمد على القيمة التي قرأناها --}}
    @if($gender == 'Male')
        {{-- ذكر --}}
        <img src="{{ asset('storage/' . ($nurse->profile->ProfilePicture ?? 'default.png')) }}"
             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
    @else
        {{-- أنثى أو أي قيمة أخرى --}}
        <img src="https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=FCE7F3&color=DB2777&bold=true"
             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
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
</div>
                </div>

                <div class="px-6 pb-6 text-center">
                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-cyan-700 transition-colors">
                        {{ $nurse->Username }}
                    </h3>
                    <p class="text-cyan-700 text-sm font-medium mb-4">
                        {{ $nurse->profile->Specialization ?? 'تخصص عام' }}
                    </p>

                    @php $avg = $nurse->orders_avg_rating ?? 0; @endphp
                    <div class="flex justify-center items-center gap-1 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-lg {{ $i <= $avg ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                        <span class="text-slate-500 text-xs ml-2">({{ number_format($avg, 1) }})</span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
   @forelse($nurses as $nurse)
        <div class="service-card"></div>
    @empty
        <p class="text-center">عذراً، لا يوجد ممرضين  حالياً.</p>
    @endforelse
    <div class="text-center mt-12">
        <a href="{{ route('Nurse.nurses') }}" class="inline-block px-8 py-3 bg-cyan-800 text-white font-bold rounded-full hover:bg-cyan-900 transition-all shadow-lg">
            عرض جميع الممرضين
        </a>
    </div>
</div>
@endsection
