@extends('layouts.layoutHome')

@section('contents')
 <p class="text-center text-3xl font-bold text-cyan-800 mb-12"></p>
<div id="nurse" class="py-16 px-4 bg-gray-50">
    <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">قائمة الممرضين</h2>
<div class="services-container">
    @forelse($nurses as $nurse)
        <div class="service-card"></div>
    @empty
        <p class="text-center">عذراً، لا يوجد ممرضين  حالياً.</p>
    @endforelse
</div>

   <div class="flex flex-wrap justify-center gap-8">
    @foreach($nurses as $nurse)
        {{-- ربط الكرت بالكامل بصفحة البروفايل --}}
        <a href="{{ route('nurse.profile', $nurse->UserID) }}" class="group block w-80">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 overflow-hidden">

                <div class="pt-8 pb-4 flex justify-center ">
                 <div class=" inline-block">
    <img src="{{ asset('storage/' . ($nurse->profile->ProfilePicture ?? '')) }}"
         loading="lazy"
         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=EBF4FF&color=1E40AF&bold=true'"
         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">

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
</div>
@endsection
