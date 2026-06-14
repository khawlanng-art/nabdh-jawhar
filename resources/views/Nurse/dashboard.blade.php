@extends('layouts.layoutnurse')

@section('contents')
<div class="p-6 md:p-10">

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-cyan-800">لوحة الإحصائيات</h2>
        <p class="text-slate-400 text-sm">مرحباً بك في لوحة تحكم الممرض، هنا تجد ملخص نشاطك.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center">
            <i class="fa-solid fa-star text-amber-400 text-2xl mb-3"></i>
            <p class="text-sm text-slate-500 font-medium">متوسط التقييمات</p>
            <p class="text-3xl font-black text-slate-800 mt-1">
             <a href="{{ route('Nurse.reviews', ['id' => $nurse->UserID]) }}" >
                @php $avg = $nurse->orders_avg_rating ?? 0; @endphp

    <span class="text-yellow-400">★</span>
    <span class="font-bold text-slate-700">{{ number_format($avg, 1) }}</span>
      <p class="text-3xl font-black text-slate-800 mt-1">
   <span class="text-xs font-bold text-slate-400 group-hover:text-cyan-600">
        اضغط لترى تقييماتك
    </span>
</p>
    </a>

            </p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center">
            <i class="fa-solid fa-bell text-blue-500 text-2xl mb-3"></i>
            <p class="text-sm text-slate-500 font-medium">الطلبات الجديدة</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ $newOrdersCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center">
            <i class="fa-solid fa-check-circle text-teal-500 text-2xl mb-3"></i>
            <p class="text-sm text-slate-500 font-medium">الطلبات المقبولة</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ $acceptedOrdersCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center">
            <i class="fa-solid fa-clock-rotate-left text-cyan-600 text-2xl mb-3"></i>
            <p class="text-sm text-slate-500 font-medium">سجل الطلبات</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ $completedOrdersCount }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <section id="about" >
        <div class="bg-gradient-to-br from-cyan-800 to-teal-700 p-8 rounded-3xl text-white shadow-lg">
            <h3 class="text-lg font-bold mb-3 flex items-center">
                <i class="fa-solid fa-hospital-user ml-2"></i> من نحن
            </h3>
            <p class="text-cyan-50 text-sm leading-relaxed">
                منصة "نبض جوار" هي جسركم الأول لتقديم رعاية صحية منزلية متميزة. نحن نؤمن بأن الممرض هو قلب المنظومة، ونسعى لتوفير بيئة عمل تقدّر جهودكم وتوصلكم بمن يحتاجون لرعايتكم بكل سهولة.
            </p>
        </div>

 </section>
 <section id="Ourvision" >
        <div class="bg-white p-8 rounded-3xl border border-teal-100 shadow-sm">
            <h3 class="text-lg font-bold text-teal-800 mb-3 flex items-center">
                <i class="fa-solid fa-eye ml-2"></i> رؤيتنا
            </h3>
            <p class="text-slate-600 text-sm leading-relaxed">
                أن نصبح الوجهة الأولى للرعاية الصحية المنزلية في المكلا من خلال تمكين كوادرنا التمريضية بأحدث الأدوات الرقمية، لنحقق معاً أعلى معايير الجودة والراحة للمريض في بيته.
            </p>
        </div>
</section>
    </div>
</div>
@endsection
