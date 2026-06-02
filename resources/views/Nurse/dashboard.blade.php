<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الممرض - نبض جوار</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
       
        :root { --main-teal: #065f46; }
        body { background-color: #f0fdfa; font-family: 'Cairo', sans-serif; }
        .sidebar { background: rgba(255, 255, 255, 0.98); }
        .nav-glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        .nurse-card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<nav class="sidebar" id="sidebar">
    <a href="{{ route('') }}" class="active" onclick="toggleMenu()">لوحة التحكم</a>
    <a href="{{ route('') }}" onclick="toggleMenu()">الطلبات القادمة</a>
    <a href="{{ route('') }}" onclick="toggleMenu()">سجل الحالات</a>
    <a href="{{ route('') }}" onclick="toggleMenu()">ملفي المهني</a>

    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="w-full text-right px-4 py-3 text-rose-600 font-bold hover:bg-rose-50 rounded-xl">
            <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
        </button>
    </form>
</nav>

<div class="main-container">
    <header class="nav-glass">
        <div class="logo-box">
            <h1 style="color: var(--main-teal);">نبض جوار - الممرض</h1>
        </div>

        <div class="nav-links">
            <a href="{{ route('') }}" class="nav-item">الرئيسية</a>
            <a href="{{ route('') }}" class="nav-item">الطلبات</a>
        </div>

        @auth
        <div class="header-right relative" id="profile-container">
            <a href="javascript:void(0)" onclick="toggleSlider()">
                <img src="https://ui-avatars.com/api/?name=Nurse&background=065f46&color=fff" class="user-avatar">
            </a>
            <div id="profileSlider" class="hidden absolute left-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border p-2 z-[9999]">
                <a href="{{ route('') }}" class="block px-4 py-3 text-sm hover:bg-teal-50 rounded-xl">تعديل الملف المهني</a>
            </div>
        </div>
        @endauth

        <div class="menu-btn" onclick="toggleMenu()"><div></div><div></div><div></div></div>
    </header>

    <div class="p-8 mt-20">
        @yield('contents')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="nurse-card">
                <h3 class="text-teal-800 font-bold">الطلبات الجديدة</h3>
                <p class="text-3xl font-black mt-2">3</p>
            </div>
            <div class="nurse-card">
                <h3 class="text-teal-800 font-bold">التقييم العام</h3>
                <p class="text-3xl font-black mt-2">4.9 ⭐</p>
            </div>
            <div class="nurse-card">
                <h3 class="text-teal-800 font-bold">الحالات النشطة</h3>
                <p class="text-3xl font-black mt-2">1</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('visible');
    }
    function toggleSlider() {
        document.getElementById('profileSlider').classList.toggle('hidden');
    }
</script>
</body>
</html>
