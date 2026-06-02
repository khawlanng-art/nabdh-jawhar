@extends('layouts.layoutHome')

@section('contents')
<style>
    body {
        background-image: url('{{ asset('images6.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;

    }
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(5px);
        z-index: -1;
    }
    footer { display: none !important; }
</style>
<div class="w-full max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white/70 backdrop-blur-xl border border-white/50 p-6 md:p-8 rounded-[2.5rem] shadow-2xl">

        <h2 class="text-2xl font-extrabold text-cyan-950 mb-6 text-center border-b border-cyan-200 pb-3">
            تعديل الملف الشخصي
        </h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="flex justify-center mb-6">
                <div class="relative group">
                <img id="imagePreview"
     src="{{ (auth()->user()->profile && auth()->user()->profile->ProfilePicture) ? asset('storage/' . auth()->user()->profile->ProfilePicture) . '?t=' . time() : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->Username) }}"
     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md"
     loading="lazy">
                    <input type="file" name="ProfilePicture" id="imageInput" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="absolute bottom-0 right-0 bg-cyan-700 text-white p-1.5 rounded-full shadow-lg">
                        <i class="fa-solid fa-camera text-[10px]"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="bg-white/50 p-3 rounded-2xl border border-white/50">
                    <label class="block text-[9px] text-cyan-800 font-black uppercase mb-0.5">اسم المستخدم</label>
                    <input type="text" name="Username" value="{{ auth()->user()->Username }}" class="w-full bg-transparent font-bold text-gray-900 focus:outline-none text-sm">
                </div>

               <div class="bg-white/50 p-3 rounded-2xl border border-white/50">
    <label class="block text-[9px] text-cyan-800 font-black uppercase mb-0.5">البريد الإلكتروني</label>
    <input type="email"
           name="email"
           value="{{ auth()->user()->email }}"
           readonly
           class="w-full bg-transparent font-bold text-gray-400 cursor-not-allowed focus:outline-none text-sm">
</div>

                <div class="bg-white/50 p-3 rounded-2xl border border-white/50">
                    <label class="block text-[9px] text-gray-500 font-black uppercase mb-0.5">رقم الهاتف</label>
                    <input type="text" name="PhoneNumber" value="{{ auth()->user()->profile->PhoneNumber ?? '' }}" class="w-full bg-transparent font-bold text-gray-900 focus:outline-none text-sm">
                </div>

                <div class="bg-white/50 p-3 rounded-2xl border border-white/50">
                    <label class="block text-[9px] text-gray-500 font-black uppercase mb-0.5">الجنس</label>
                    <select name="Gender" class="w-full bg-transparent font-bold text-gray-900 focus:outline-none text-sm">
                        <option value="Male" {{ (auth()->user()->profile->Gender ?? '') == 'Male' ? 'selected' : '' }}>ذكر</option>
                        <option value="Female" {{ (auth()->user()->profile->Gender ?? '') == 'Female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>
            </div>

            <div class="bg-white/50 p-3 rounded-2xl border border-white/50 mt-4">
                <label class="block text-[9px] text-gray-500 font-black uppercase mb-0.5">العنوان</label>
                <textarea name="Address" class="w-full bg-transparent font-bold text-gray-900 focus:outline-none h-16 text-sm">{{ auth()->user()->profile->Address ?? '' }}</textarea>
            </div>

            <button type="submit" class="w-full mt-6 py-3 bg-cyan-800 hover:bg-cyan-900 text-white rounded-2xl font-black transition-all shadow-md text-sm">
                حفظ التعديلات
            </button>

        </form>



    </div>
</div>
<script>
    // وظيفة تغيير الصورة مباشرة
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
