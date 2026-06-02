@extends('layouts.layoutHome')

@section('contents')
<div id="services" class="services-section py-16 px-4 bg-gray-50 w-full">
    <div class="max-w-7xl mx-auto">

        @php
            $groupedServices = $services->groupBy('CategoryName');
        @endphp

        @foreach($groupedServices as $categoryName => $servicesInCategory)
            <h2 class="text-center text-2xl font-bold text-cyan-800 mt-16 mb-8 border-b-2 border-cyan-200 pb-4 inline-block mx-auto block">
                {{ $categoryName }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 justify-items-center">
                @foreach($servicesInCategory as $service)
                   <div class="w-72 flex flex-col h-full group overflow-hidden rounded-lg border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-lg">

    <div class="overflow-hidden h-40 flex items-center justify-center bg-gray-50">
         @if($service->IconURL)
        @if(Str::contains($service->IconURL, ['services/', '/', '.']))
            <img src="{{ Storage::url($service->IconURL) }}"
                 alt="{{ $service->ServiceName }}"
                 class="w-full max-w-md h-80 object-cover rounded-3xl shadow-lg border border-slate-100">
        @else
            <span class="text-6xl p-10 bg-slate-100 rounded-full text-cyan-700">
                {{ $service->IconURL }}
            </span>
        @endif
    @else
        <div class="w-full h-80 flex items-center justify-center bg-slate-50 rounded-3xl">
            <i class="fa-solid fa-stethoscope text-cyan-600 text-8xl"></i>
        </div>
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
        @endforeach

    </div>
</div>
@endsection
