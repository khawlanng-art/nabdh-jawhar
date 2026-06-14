<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lateef&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة الممرض </title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>    :root {
            --glow-color: rgba(118, 171, 174, 0.4);
            --gold-gradient: linear-gradient(135deg, #c5a059 0%, #9a7b41 100%);
            --glass-bg:   #ffffff07;

            --text-dark: #2c5672;
            --main-teal:  #274a5c;
            --header-height: 650px;
        }
* { box-sizing: border-box !important; }

        body {

            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(231, 238, 237, 0.4) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.3) 0%, transparent 40%),
        linear-gradient(135deg, #f0f9f8 0%, #ffffff80 100%);
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        .main-container {
            width: 100%;
flex: 1;



        }
/* Sidebar الأساسي */
.sidebar {
    position: fixed;
    right: -300px; /* مخفية خارج الشاشة جهة اليمين */
    top: 0;
    width: 300px;
    height: 100%;
    background: white;
    z-index: 1000;
    transition: 0.3s;
}

/* الكلاس الذي يُضاف عند الضغط */
.sidebar.active {
    right: 0;
}

/* الـ Overlay لغلق القائمة عند الضغط خارجه */
.overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

.overlay.active {
    display: block;
}
        .info-banner-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            width: 100%;
            margin-bottom: 30px;
        }

        .info-card-slim {
            background: white;
            border-radius: 20px;
            padding: 20px;
            position: relative;
            border: 1px solid #edf2f7;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: 0.3s ease;
        }

        .info-card-slim:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .text-side h3 { margin: 0; font-size: 18px; color: var(--text-dark); }
        .text-side p { font-size: 12px; color: #718096; margin: 5px 0 12px 0; }

        .card-pill {
            font-size: 10px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 50px;
            background: #f7fafc;
            display: inline-block;
            color: #4a5568;
        }
        .card-pill.gold { background: #fffaf0; color: #b45309; }
        .card-pill.teal { background: #f0fff4; color: #2c7a7b; }

        .card-img { width: 55px; height: 55px; object-fit: contain; }

        .mini-gold-btn, .mini-teal-btn {
            padding: 6px 15px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: 'Cairo';
        }
        .mini-gold-btn { background: var(--gold-gradient); color: white; }
        .mini-teal-btn { background: var(--main-teal); color: white; }

        .action-link { font-size: 11px; color: var(--main-teal); text-decoration: none; font-weight: 700; }

        .highlight-gold {
            border: 1px solid rgba(197, 160, 89, 0.3);
            background: linear-gradient(to bottom right, #ffffff, #fffdfa);
        }

        @media (max-width: 900px) {
            .info-banner-grid { grid-template-columns: 1fr; }
        }

        /* 1. الهيدر */
        .header-section {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            margin-bottom: 25px;

    gap: 12px;
        }

        .header-right { justify-content: flex-end; gap: 15px; }, .header-left { flex: 1; display: flex; align-items: center; }
        .header-left { justify-content: flex-end; gap: 15px; }
        .header-center { flex: 1; display: flex; justify-content: center; }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--main-teal);
            padding: 2px;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.3s ease;
            object-fit: cover;
        }

        .notification-wrapper { position: relative; color: var(--text-dark); cursor: pointer; }
        .notification-icon svg { width: 26px; height: 26px; opacity: 0.8; }
        .badge {
            position: absolute; top: -2px; right: -2px; background: #e74c3c;
            color: white; font-size: 10px; font-weight: bold; min-width: 16px;
            height: 16px; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; border: 2px solid white;
        }

        .logo-box img { max-height: 50px; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.1)); }

        @media (max-width: 600px) {
            .user-avatar { width: 35px; height: 35px; }
            .logo-box img { max-height: 40px; }
            .header-section { padding: 5px 0; }
        }

        .menu-btn {
            display: none;
            background: var(--glass-bg);
            border: 1px solid rgba(255,255,255,0.5);
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            z-index: 1001;

        }
        .menu-btn div { width: 25px; height: 3px; background: var(--main-teal); margin: 5px 0; transition: 0.3s; }

        /* 2. شريط القوائم */
        .nav-glass {

            background: var(--glass-bg);
            backdrop-filter: blur(15px);

 position: fixed;
            display: flex;
            justify-content: space-between; /* تعديل لضمان توزيع البحث والروابط */
            align-items: center;
            gap: 15px;
            padding: 10px 20px;
            margin-bottom: 30px;
            width: 100%;

        }

        .nav-links { display: flex; gap: 10px; }
        .nav-item {
            padding: 10px 20px;
            font-weight: 700;
            color:rgb(64, 111, 129);
            text-decoration: none;
            transition: 0.3s;
            border-radius: 12px;
            white-space: nowrap;
        }
        .nav-item.active, .nav-item:hover { background: rgba(179, 214, 230, 0.438); color: var(--main-teal); }


        .sidebar {
            /* الأسطر المهمة للحل: */
    overflow-y: auto; /* هذا هو السطر المسؤول عن إظهار شريط التمرير */
    -webkit-overflow-scrolling: touch; /* لجعل التمرير ناعماً في الجوال */
            position: fixed;
            top: 0;
            left: -100%;
            width: 280px;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            transition: 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
            display: flex;
            flex-direction: column;
            padding: 80px 20px;
            box-shadow: -10px 0 30px rgba(0,0,0,0.1);
        }
        .sidebar.open { left: 0; }
        .sidebar a { padding: 15px; font-size: 18px; font-weight: 700; color: var(--text-dark); text-decoration: none; border-bottom: 1px solid rgba(0,0,0,0.05); }

        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); display: none; z-index: 999; }
        .overlay.visible { display: block; }

        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 50px; width: 100%; }
        .card-3d { background: white; border-radius: 25px; padding: 30px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.03); transition: 0.4s; }
        .card-3d:hover { transform: translateY(-8px); }
        .gold-btn { background: var(--gold-gradient); color: white; border: none; padding: 10px 25px; border-radius: 12px; font-weight: 700; cursor: pointer; font-family: 'Cairo'; }

        .nurses-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; width: 100%; }
        .nurse-card-3d { background: var(--glass-bg); backdrop-filter: blur(10px); border-radius: 20px; padding: 15px; display: flex; align-items: center; border: 1px solid white; }
        .nurse-img { width: 60px; height: 60px; border-radius: 50%; border: 2px solid #c5a059; margin-left: 15px; object-fit: cover; }

        .footer { width: 100%; background:#06B6D4; backdrop-filter: blur(10px); border-top: 1px solid rgba(0,0,0,0.05); padding: 30px 0; text-align: center; margin-top: 50px; }

@media (max-width: 850px) {
    .logo-box img {
        max-height: 40px;}
    /* التأكد من أن الهيدر حاوية مرنة توزع العناصر على الأطراف */
    .nav-glass {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: center !important;
        width: 100% !important;
        padding: 10px 15px !important;
        position: relative;
        t
    }

    /* 1. اللوجو (يمين) */
    .logo-box {
        order: 1 !important;
        display: flex !important;
        align-items: center;
    }

 .login-btn {
        order: 3 !important;
        display: flex !important;
        align-items: center;
    }
    /* 2. البحث (منتصف - يتمدد) */
    .nav-search {
        order: 2 !important;
        display: block !important;
        flex-grow: 1 !important;
        margin: 0 15px !important;
        min-width: 0 !important; /* هذا مهم جداً لمنع البحث من دفع العناصر خارج الشاشة */
    }

   .menu-btn {
    order: 4 !important;           /* لضمان أنه يأتي بعد اللوجو والبحث */
    display: block !important;
    margin-right: auto !important; /* هذا هو السطر الذي يدفعه لليسار */
    margin-left: 0 !important;     /* تأكد من تصفير الهامش الأيسر */
    cursor: pointer;

}
    /* إخفاء العناصر الزائدة في الجوال */
    .nav-links, .notification-wrapper, #profile-container {
        display: none !important;
    }
}

        .nav-search { flex-grow: 1; max-width: 300px; }
        .search-container {
            display: flex;
            background: white;
            border-radius: 50px;
            padding: 2px 5px 2px 15px;

            align-items: center;
        }
        .search-input { width: 100%; background: transparent; border: none; outline: none; font-family: 'Cairo'; font-size: 13px; color: var(--text-dark); }
        .search-btn {
            background: var(--main-teal); color: white; border: none; width: 32px; height: 32px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s; flex-shrink: 0;
        }
        #profileSlider {

    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.hidden {
    display: none;
    opacity: 0;
}
.about-us-section {
    width: 100%;
    height: 100%;
    background-color: #f8fafc;
    display: flex;
    flex-direction: row-reverse; /* هذا يجعل النص يمين والصورة يسار */
    align-items: center;
    padding: 40px;
    gap: 40px;
    overflow: hidden;

}

.about-image-wrapper {
    flex: 1;
    height: 100%;
}

.about-image-wrapper img {
    width: 100%;
    height: 80%;

}

.about-text-wrapper {
    flex: 1;
    padding: 20px;


}

.about-text-wrapper h2 {
    color: #0e7490;
    font-size: 3rem;
    margin-bottom: 20px;
    font-weight: bold;

}

.about-text-wrapper p {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #334155;
    text-align: justify;
}

/* لجعل التصميم يتجاوب في الجوال */
@media (max-width: 768px) {
    .about-us-section {
        flex-direction: column;
        height: auto;
    }
}
[id] {
    scroll-margin-top: 100px; /* اضبط الرقم حسب ارتفاع الهيدر لديك */
}
.fixed {
    position: fixed !important;
}
/* إخفاء الإشعارات فوراً بانتظار فحص الذاكرة */
    .notification-wrapper-item { display: none; }
    .overlay-text {
    color: white;
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
    transition: opacity 0.5s ease; /* تأثير تلاشي */
}
#dynamic-text {
        line-height: 1.6; /* جعل المسافة بين الأسطر مريحة للعين */
    }
    #text-box {
    max-width: 600px; /* تحديد عرض أقصى للنص */
    margin: 0 auto;   /* توسيط الحاوية */
}
@keyframes slideFade {
    0% { opacity: 0; transform: translateY(20px); } /* بداية الدخول: شفاف ومن الأسفل */
    20% { opacity: 1; transform: translateY(0); }  /* اكتمال الدخول */
    80% { opacity: 1; transform: translateY(0); }  /* الثبات */
    100% { opacity: 0; transform: translateY(-20px); } /* نهاية الخروج: شفاف وللأعلى */
}
[x-cloak] { display: none !important; }
.animate-text {
    animation: slideFade 4s ease-in-out infinite;
}
</style>
</head>
<body x-data="{
    showAcceptedModal: false,
    selectedOrderId: null,
    openModal(id) {
        this.selectedOrderId = id;
        this.showAcceptedModal = true;
    }
}">

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>
<nav class="sidebar" id="sidebar">

    <a href="{{ route('Nurse.dashboard') }}" class="active" onclick="toggleMenu()">الرئيسية</a>
    <a href="{{ route('orders.accepted') }}" onclick="toggleMenu()"> الطلبات المقبولة</a>
     <a href="{{ route('nurse.all_orders') }}" onclick="toggleMenu()">سجل الطلبات</a>

    <a href="{{ route('Nurse.dashboard') }}#about" onclick="toggleMenu()"> من نحن</a>


    <a href="{{ route('profile.edit') }}" onclick="toggleMenu()">تعديل الملف الشخصي</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-right px-4 py-2 text-rose-500 hover:bg-rose-900/20">
            <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
        </button>
    </form>
</nav>

<div class="main-container" >

    @if(request()->routeIs('Nurse.dashboard'))
    <div class="div-with-background " style=" background: linear-gradient(rgba(148, 148, 148, 0.315), rgba(184, 241, 255, 0.5)),
                url('{{ asset('3.png') }}'); width: 100%;
            height: 650px;
            background-size: cover;
            background-position: center;

position: relative;
    overflow: hidden;
            background-repeat: no-repeat;">

@endif

   <header class="nav-glass">

       <div  class="logo-box" style="display: flex; align-items:  center; gap: 10px;">

 <div class="text-teal-400 w-16 h-16 md:w-16 md:h-16">
    @include('partials.logo-svg')
</div>

    <h1 class="font-extrabold font-Tajawal leading-none"
        style="
            margin: 0;
            color: #0e7490;
            text-shadow:
                1px 1px 0px #ffffff,
                2px 2px 0px #a3c9d1,
                3px 3px 0px #8eb4bd,
                4px 4px 0px #799fa7,
                5px 5px 10px rgba(0,0,0,0.2);
            letter-spacing: -0.5px;
            white-space: nowrap; /* لمنع نزول النص لسطر جديد */
        ">
        نبض جوار
    </h1>
</div>

<div class="header-left notification-wrapper relative"
     x-data="{
         showNotifications: false,
         showActionModal: false,
         showDetailsModal: false,
         showCancelConfirmModal: false,
         selectedOrder: null

     }">

    <!-- أيقونة الإشعارات -->
    <div class="notification-icon cursor-pointer" @click.stop="showNotifications = !showNotifications">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] rounded-full px-1.5 font-bold">
            {{ $notifications->count() + $cancelledNotifications->count() }}
        </span>
    </div>

    <!-- قائمة الإشعارات -->
    <div x-show="showNotifications" @click.away="showNotifications = false" x-cloak
        class="absolute left-0 mt-2 w-72 bg-white shadow-xl rounded-2xl p-4 z-50 border border-slate-100">
<div class="mb-4">
    <h3 class="font-bold text-slate-800 mb-3 border-b pb-2">الاشعارات</h3>

    @if($notifications->isEmpty() && $cancelledNotifications->isEmpty())
        <p class="text-xs text-slate-400 p-4 text-center">لا توجد إشعارات حالياً.</p>
    @else
        @if($notifications->isNotEmpty())
            <h4 class="text-xs font-bold text-slate-500 mb-2">طلبات جديدة</h4>
            @foreach($notifications as $order)
                <div class="p-2 border-b hover:bg-slate-50 cursor-pointer"
                     @click="showActionModal = true; selectedOrder = {{ $order->id }}">
                    <p class="text-sm font-bold">طلب جديد #{{ $order->id }}</p>
                </div>
            @endforeach
        @endif

        @if($cancelledNotifications->isNotEmpty())
            <h4 class="text-xs font-bold text-red-500 mb-2 mt-4">طلبات ملغاة</h4>
            @foreach($cancelledNotifications as $cancelled)
                <div class="p-3 border-b hover:bg-red-50 cursor-pointer text-red-700 flex justify-between items-center"
                     @click.stop="selectedOrder = {{ $cancelled->id }}; showCancelConfirmModal = true; showNotifications = false;">
                    <p class="text-sm font-bold">الطلب #{{ $cancelled->id }} ملغى</p>
                    <span class="text-[10px] bg-red-100 px-2 py-1 rounded">عرض</span>
                </div>
            @endforeach
        @endif
    @endif
</div>
</div>


<template x-teleport="body">
    <div x-show="showCancelConfirmModal" x-cloak
         class="fixed inset-0 z-[999999] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
         @click.outside="showCancelConfirmModal = false">

        <div class="bg-white p-6 rounded-3xl w-80 shadow-2xl">
            <h3 class="text-lg font-bold text-red-600 mb-2">تنبيه!</h3>
            <p class="text-sm text-slate-600 mb-4">
                تم إلغاء الطلب رقم #<span x-text="selectedOrder" class="font-bold"></span> من قبل المريض.
            </p>

            <form action="/orders/confirm-cancel" method="POST">
                @csrf
                <input type="hidden" name="order_id" :value="selectedOrder">
                <button type="submit"
                        class="w-full bg-slate-800 text-white py-2 rounded-lg hover:bg-slate-700 transition">
                    حسناً
                </button>
            </form>
        </div>
    </div>
</template>
<template x-teleport="body">
    <div x-show="showActionModal"
         x-cloak
         class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm"
         @click.away="showActionModal = false">

     @if(isset($order))
   <div class="bg-white p-6 rounded-3xl w-full max-w-sm shadow-2xl">
            <h3 class="font-bold mb-4">الطلب رقم #{{ $order->id }}</h3>

            <div class="flex flex-col gap-2">
            <form action="{{ route('order.accept', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded-xl font-medium transition-colors">
                            قبول
                        </button>
                    </form>

                    <form action="{{ route('order.reject', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white py-2 rounded-xl font-medium transition-colors">
                            رفض
                        </button>
                    </form>

                <button class="bg-slate-200 text-black w-full py-2 rounded-xl" @click="showDetailsModal = true; selectedOrder = {{ $order->id }}">
    عرض التفاصيل
</button>
    </div>

   </div>
       @endif
    </div>
</template>


<template x-teleport="body">
    <div x-show="showDetailsModal"
         x-cloak
         class="fixed inset-0  overflow-y-auto z-[999999] flex items-center justify-center p-4 bg-black/50 backdrop-blur-md"
         @click.away="showDetailsModal = false">

         <div @click.stop>
             <h2 class="text-xl font-bold mb-4">تفاصيل الطلب رقم #<span x-text="selectedOrder"></span></h2>

             <div class="max-w-m mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-xl">

        @if(isset($order))

            <h1 class="text-3xl font-black text-cyan-800 mb-6 border-b pb-4">تفاصيل الطلب #{{ $order->id }}</h1>

            <div class="mb-8">
                 <span class="px-4 py-2 text-lg font-bold rounded-full {{ $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : ($order->status == 'Accepted' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                    {{ $order->status == 'Pending' ? 'قيد الانتظار' : ($order->status == 'Accepted' ? 'تم القبول' : 'مكتمل') }}
                 </span>
            </div>

            <div class="grid {{ $order->service->CategoryName == 'رعاية' ? 'grid-cols-3' : 'grid-cols-2' }} gap-4 mb-8">
                <div class="p-4 bg-cyan-50 rounded-xl">
                    <p class="text-xs text-gray-500">عدد المرضى</p>
                    <p class="font-bold text-xl">{{ $order->patients_count }}</p>
                </div>

                @if($order->service->CategoryName == 'رعاية')
                    <div class="p-4 bg-cyan-50 rounded-xl">
                        <p class="text-xs text-cyan-800">مدة الخدمة</p>
                        <p class="font-bold text-xl">{{ $order->service_duration }} ساعة</p>
                    </div>
                @endif

                <div class="p-4 bg-cyan-800 rounded-xl">
                    <p class="text-xs text-white">إجمالي السعر</p>
                    <p class="font-bold text-xl text-white">{{ number_format($order->total_price) }} ريال</p>
                </div>
            </div>



           <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-8">
    <h2 class="text-xl font-black text-cyan-950 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-user-injured text-cyan-600"></i> بيانات المريض والخدمة
    </h2>

    @php
        $pData = !empty($order->review) ? json_decode($order->review, true) : [];
        $displayName = !empty($pData['name']) ? $pData['name'] : ($order->user->Username ?? 'غير معروف');
        $displayPhone = !empty($pData['phone']) ? $pData['phone'] : ($order->user->Phone ?? 'لا يوجد');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- عرض اسم الخدمة --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-stethoscope"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">الخدمة المطلوبة</span>
                <span class="text-sm font-bold text-slate-800">{{ $order->service->ServiceName ?? 'غير محدد' }}</span>
            </div>
        </div>

        {{-- عرض الاسم --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">اسم المريض</span>
                <span class="text-sm font-bold text-slate-800">{{ $displayName }}</span>
            </div>
        </div>

        {{-- عرض الهاتف --}}
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-700">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <span class="block text-[10px] uppercase font-black text-slate-400">رقم التواصل</span>
                <span class="text-sm font-bold text-slate-800 tabular-nums" dir="ltr">{{ $displayPhone }}</span>
            </div>

        </div>

    </div>



        </div>
@endif


             <button @click="showDetailsModal = false" class="w-full mt-6 bg-slate-800 text-white py-3 rounded-2xl">
                 إغلاق التفاصيل
             </button>
  </div>
    </div>
        </div>
</template>
   </div>
        <div class="nav-links">
           <a href="{{ route('Nurse.dashboard') }}" class="nav-item">الرئيسية</a>
            <a href="{{ route('orders.accepted') }}" class="nav-item">الطلبات المقبولة</a>
            <a href="{{ route('nurse.all_orders') }}" class="nav-item">سجل الطلبات</a>

      <a href="{{ route('Nurse.dashboard') }}#about" class="nav-item">من نحن</a>
        </div>

        <div class="nav-search">

            <div class="nav-search flex justify-center py-4">
    <form action="{{ route('nurse.search.results') }}" method="GET" class="search-container flex items-center bg-white border border-gray-300 rounded-full shadow-sm hover:shadow-md transition-shadow duration-300 w-full max-w-md overflow-hidden">

        <input type="text"
               name="nurse_search_filter"
           value="{{ request('nurse_search_filter') }}"
           placeholder="ابحث في طلباتي (رقم، اسم، خدمة)..."
               class="w-full py-2 px-6 text-sm text-gray-700 outline-none placeholder-gray-400"
               value="{{ request('search') }}">

        <button type="submit" class="search-btn">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
</button>
    </form>
</div>


        </div>
@auth
@php $nurse = auth()->user(); @endphp
<div class="relative group cursor-pointer">

  <div class="relative inline-block" onclick="toggleSlider()">

    <a href="javascript:void(0)" class="profile-trigger">
@if($nurse->profile && $nurse->profile->ProfilePicture)
        <img src="{{ asset('storage/' . $nurse->profile->ProfilePicture) }}?v={{ time() }}"
             class="user-avatar w-12 h-12 rounded-full border-2 border-slate-200 object-cover">
    @else
        <div class="w-12 h-12 rounded-full border-2 border-slate-200 bg-cyan-600 flex items-center justify-center text-white font-bold text-lg">
            {{ mb_substr($nurse->Username, 0, 1) }}
        </div>
    @endif
@if($nurse->Status == 'Available')
        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-green-500 ring-2 ring-white"></span>
    @elseif($nurse->Status == 'Busy')
        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-red-500 ring-2 ring-white"></span>
    @else($nurse->Status == 'Offline')
        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-gray-400 ring-2 ring-white"></span>


    @endif
    </a>

</div>

   <div id="profile" class="hidden absolute left-0 mt-3 w-56 bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-slate-100 z-[9999] p-2 space-y-1">




    <a href="{{ route('nurse.profile.edit') }}" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-slate-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-xl transition-all font-semibold">
        <i class="fa-solid fa-user-pen"></i> تعديل البروفايل
    </a>

    <div class="border-t border-slate-100 my-1"></div>

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-rose-600 hover:bg-rose-50 rounded-xl transition-all font-semibold">
            <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
        </button>
    </form>

</div>

</div>

@endauth

<div class="menu-btn" onclick="toggleMenu()">
        <div></div><div></div><div></div>
    </div>

    </header>
</div>
@if(session('success'))
    <div id="success-message" class="fixed top-20 left-5 z-[9999]">
        <div class="bg-green-600 text-white px-6 py-3 rounded-2xl shadow-lg font-bold flex items-center animate-fade-in-left">
            <span class="ml-2">✓</span>
            {{ session('success') }}
        </div>
    </div>

    <script>
        // إخفاء تلقائي بعد 4 ثوانٍ
        setTimeout(function() {
            let msg = document.getElementById('success-message');
            if (msg) msg.style.display = 'none';
        }, 4000);
    </script>
@endif
@yield('contents')
    <!-- الفوتر (مشابه لـ image_2bb012.png) -->
    <footer class="bg-slate-900 footer ">
    <div class="w-full flex flex-col md:flex-row justify-between items-center gap-6 px-4">

        <div class="text-center md:text-right">
            <h2 class="text-2xl font-bold text-cyan-500 ">نبض جوار</h2>
        </div>

        <div class="flex flex-wrap justify-center gap-4 text-m">
            <a href="javascript:void(0)" onclick="openPrivacyModal()" class="text-slate-400 hover:text-cyan-500  transition-colors">الخصوصية</a>
            <a href="#Ourvision" class="text-slate-400 hover:text-cyan-500  transition-colors">رؤيتنا</a>
        <a href="javascript:void(0)" onclick="openTermsModal()" class="text-slate-400 hover:text-cyan-500 transition-colors">شروط الانضمام</a>
        </div>

        <div class="flex flex-col items-center  text-m gap-1">
            <a href="mailto:support@nabdjawar.com" class="text-cyan-500   md:text-left hover:underline">
                support@nabdjawar.com
            </a>
            <p class="text-slate-500">© {{ date('Y') }} جميع الحقوق محفوظة لنبض جوار</p>
        </div>

    </div>
</footer>

<div id="privacyModal" class="hidden fixed inset-0 z-[10001] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl p-8 w-full max-w-lg shadow-2xl relative max-h-[80vh] overflow-y-auto">
        <button onclick="closePrivacyModal()" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

        <h2 class="text-center font-bold text-xl text-cyan-800 mb-6">سياسة الخصوصية - نبض جوار</h2>

        <div class="text-right text-slate-700 space-y-4 text-sm leading-relaxed">

            <ul class="list-disc pr-5 space-y-2">
                <li>نحن نلتزم بحماية بياناتك الشخصية واستخدامها فقط لغرض تقديم الخدمة.</li>

            </ul>
            <p class="text-center mt-6 font-bold text-cyan-800">هدفنا هو حمايو بياناتك بكل أمان وخصوصية.</p>
        </div>

        <button onclick="closePrivacyModal()" class="w-full mt-6 bg-cyan-800 text-white py-3 rounded-2xl font-bold">حسناً</button>
    </div>
</div>
<div id="termsModal" class="hidden fixed inset-0 z-[10001] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl p-8 w-full max-w-lg shadow-2xl relative max-h-[80vh] overflow-y-auto">
        <button onclick="closeTermsModal()" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

        <h2 class="text-center font-bold text-xl text-cyan-800 mb-6">شروط الانضمام - نبض جوار</h2>

        <div class="text-right text-slate-700 space-y-4 text-sm leading-relaxed">
            <p>عند استخدامك لمنصة <strong>نبض جوار</strong>، فإنك توافق على الشروط التالية:</p>
            <ul class="list-disc pr-5 space-y-2">
                <li>الالتزام المهني بالأخلاقيات.</li>
                    <li>الحفاظ على سرية معلومات المرضى.</li>
                    <li>المسؤولية عن دقة البيانات المقدمة.</li>
            </ul>
            <p class="text-center mt-6 font-bold text-cyan-800">نحن هنا لضمان تجربة خدمة آمنة وموثوقة للجميع.</p>
        </div>

        <button onclick="closeTermsModal()" class="w-full mt-6 bg-cyan-800 text-white py-3 rounded-2xl font-bold">موافق</button>
    </div>
</div>

<script>
    function updateStatus(status) {
    // استخدم fetch لإرسال الطلب إلى المسار (Route) الخاص بتحديث الحالة
    fetch('/orders/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            order_id: selectedOrder, // المتغير الذي يحمل رقم الطلب
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('تم تحديث الحالة بنجاح إلى: ' + status);
            showDetailsModal = false; // إغلاق المودال
            location.reload(); // تحديث الصفحة لرؤية التغيير
        }
    });
}
    function toggleSlider() {
    const profileMenu = document.getElementById('profile');
    if (profileMenu) {
        profileMenu.classList.toggle('hidden');
    }
}

// إضافة مهمة: إغلاق القائمة عند النقر في أي مكان خارجها
window.addEventListener('click', function(e) {
    const profileMenu = document.getElementById('profile');
    const trigger = document.querySelector('.profile-trigger');

    // إذا نقرت في مكان غير القائمة وغير الزر، أغلق القائمة
    if (!profileMenu.contains(e.target) && !trigger.contains(e.target)) {
        profileMenu.classList.add('hidden');
    }
});
      function openTermsModal() {
    document.getElementById('termsModal').classList.remove('hidden');
}

function closeTermsModal() {
    document.getElementById('termsModal').classList.add('hidden');
}
function toggleSlider() {
    const slider = document.getElementById('profile');
    slider.classList.toggle('hidden');
}
function openPrivacyModal() {
        document.getElementById('privacyModal').classList.remove('hidden');
    }

    function closePrivacyModal() {
        document.getElementById('privacyModal').classList.add('hidden');
    }
function openorerModal() {
        document.getElementById('orerModal').classList.remove('hidden');
    }

    function closeorerModal() {
        document.getElementById('orerModal').classList.add('hidden');
    }


    // إغلاق القائمة عند الضغط في أي مكان خارجها
    document.addEventListener('click', function(event) {
        const slider = document.getElementById('profile');
        const container = document.getElementById('profile-container');


    });

   const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');
   if (imageInput) {
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (imagePreview) imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
}
function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // تبديل الكلاس لفتح/غلق القائمة
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
}
    </script>
</body>
</html>
