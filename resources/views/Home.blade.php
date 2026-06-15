@extends('layouts.layoutHome')

@section('contents')
<div class="max-w-7xl mx-auto py-16 px-6 space-y-24">

    <section id="about" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="overflow-hidden rounded-3xl shadow-2xl">
            {{-- تأكد من وجود ملفات الصور في مجلد public --}}
            <img src="{{ asset('images2.png') }}" alt="فريق العمل" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
        </div>
        <div class="space-y-6">
            <h2 class="text-4xl font-black text-cyan-900 border-r-8 border-cyan-700 pr-4">من نحن</h2>
            <p class="text-lg text-slate-600 leading-relaxed text-justify">
                نبض جوار هو من أفضل المنصات الإلكترونية لتقديم خدمة الرعاية الصحية والطبية في المنزل...
            </p>
        </div>
    </section>

    <div id="nurse" class="max-w-7xl mx-auto py-16 px-6 space-y-24">
        <h2 class="text-center text-3xl font-bold text-cyan-800 mb-12">الممرضون المميزون</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-20 justify-items-center">
            @foreach($nurses as $nurse)
                <a href="{{ route('nurse.profile', $nurse->UserID) }}" class="group block w-80">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="pt-8 pb-4 flex justify-center ">
                            <div class="inline-block relative">

                                {{-- المنطق الجديد: التحقق من وجود الصورة --}}
                                @php
                                    $profilePic = $nurse->profile ? $nurse->profile->ProfilePicture : null;
                                    $imagePath = 'storage/' . $profilePic;
                                    // التحقق: هل اسم الملف موجود؟ وهل الملف موجود فعلياً في مجلد public؟
                                    $hasImage = $profilePic && file_exists(public_path($imagePath));
                                @endphp

                                @if($hasImage)
                                    <img src="{{ asset($imagePath) }}"
                                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    {{-- صورة افتراضية ذكية إذا لم توجد صورة الممرض --}}
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($nurse->Username) }}&background=FCE7F3&color=DB2777&bold=true"
                                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                @endif

                                <span class="absolute w-5 h-5 border-4 border-white rounded-full ring-2 ring-white z-20
                                {{ match(strtolower($nurse->Status)) {
                                    'available' => 'bg-green-500',
                                    'busy'      => 'bg-red-500',
                                    'offline'   => 'bg-slate-400',
                                    default     => 'bg-gray-400',
                                } }}" style="margin-top: -3ch; margin-left: 6.5rem;">
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
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
