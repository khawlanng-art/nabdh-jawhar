
<html lang="ar" dir="rtl">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google" content="notranslate">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | نبض جوار</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            --primary-green:#ffffff;
            --dark-green: #06B6D4;
            --soft-green: #ecfdf5;
            --sidebar-dark: #06B6D4;
            --text-main: #ffffff;
            --border-light: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Tajawal', sans-serif; }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            color: var(--text-main);
            font-size: 14px;

        }


        .sidebar {
            width: 130ch;
            height: 50vh;
            background: var(--sidebar-dark);
            color: white;
            padding: 30px 20px;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;

        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 800;
            color: var(--primary-green);
            font-size: 1.4rem;
        }
.no-scrollbar::-webkit-scrollbar {
    display: none;
}


.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: 0.3s;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-green);
        }






        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            border: 1px solid var(--border-light);
            text-align: center;
            transition: 0.3s ease;
        }

        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }


        .btn-approve {
            background: var(--primary-green);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-approve:hover { background: var(--dark-green); transform: scale(1.05); }

        .btn-view {
            background: #f1f5f9;
            color: #475569;
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.85rem;
        }
   .sidebar {
    width: 260px;
    height: 100vh;
    background: var(--sidebar-dark);
    position: fixed;
    right: 0;
    top: 0;
    transform: translateX(0);
    transition: transform 0.3s ease;

}

.main-content {
    margin-right: 260px;
    width: calc(100% - 260px);
    padding: 40px;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(100%);
    }

    .sidebar.open {
        transform: translateX(0);
    }


.main-content {
    margin-right: 0 !important;
    width: 100% !important;
    padding: 15px !important;
    background-color: #f8fafc;
    min-height: 100vh;
    overflow-x: hidden;
}


.main-content h1, .main-content h2, .main-content h3 {
    font-size: 1rem !important;
    font-weight: 800 !important;
    margin-bottom: 1rem !important;
}

.main-content table {
    width: 100%;
    font-size: 0.75rem !important;
    border-collapse: separate;
    border-spacing: 0 5px;
    table-layout: auto;
border-spacing: 0 2px !important;
}

.main-content td {
    padding: 2px 10px !important;
    line-height: 1 !important;
    height: 35px !important;
}


.main-content td img {
    width: 24px !important;
    height: 24px !important;
}


.main-content td .flex {
    gap: 4px !important;
}
.main-content th {
    padding: 8px 12px !important;
    font-size: 11px !important;
    color: #64748b;
    text-transform: uppercase;
    text-align: right;
}

.main-content td {
    padding: 5px 12px !important;
    font-size: 11px !important;
    vertical-align: middle;
}

.main-content td img {
    width: 28px !important;
    height: 28px !important;
    border-radius: 6px;
}

.modal-main-container {
        background-color: #ffffff;
        margin: 40px auto;
        width: 90%;
        max-width: 500px;
        border-radius: 15px;
        overflow: hidden;
        direction: rtl;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* الـ DIV الإضافي: هو المسؤول عن "تنفيس" المحتوى */
    .modal-content-wrapper {
        padding: 30px !important; /* هذه هي المسافة التي طلبتها عن الجدران */
        box-sizing: border-box !important;
    }

    /* تنسيق الحقول لضمان عدم خروجها عن الحواف */
    .form-input-custom {
        width: 100% !important;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;

        box-sizing: border-box !important; /* ضروري جداً لمنع تمدد الحقول */
        background-color: #f9fafb;
    }

    .form-label-custom {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }
.main-content td .btn,
.main-content td button,
.main-content td a,
.main-content .flex.gap-2 a,
.main-content .flex.gap-2 button {
    padding: 3px 6px !important;
    font-size: 9px !important;
    border-radius: 5px !important;
}


.main-content .table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    margin-bottom: 15px;
}
}
.custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

.hide-scrollbar {

    -webkit-overflow-scrolling: touch;
}

.hide-scrollbar::-webkit-scrollbar {
    display: none;
    width: 0 !important;
    height: 0 !important;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.sidebar {
    transition: transform 0.3s ease-in-out;
    position: fixed;
    top: 0;
    right: 0;
    height: 100vh;
    z-index: 1000;
}


.toggle-btn {
    display: none;
    position: fixed;
    top: 15px;
    right: 15px;
    z-index: 1001;
    padding: 10px;
    background: #1e293b;
    color: white;
    border: none;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .toggle-btn {
        display: block; }
}
.highlight-blue-force, .highlight-blue-force td {
        background-color: #dbeafe !important; /* لون أزرق فاتح جداً (Tailwind blue-100) */
        transition: background-color 0.8s ease-in-out !important;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>

    <div class="sidebar space-y-1 px-3 text-s text-sm h-screen overflow-y-auto hide-scrollbar">

    <div class="sidebar-header flex flex-col items-center py-2 border-b border-slate-100 mb-1 space-y-1">
   <div class="text-teal-400 w-16 h-16 md:w-16 md:h-16">
             @include('partials.logo-svg')

    </div>

    <h2 class="text-3xl font-black text-slate-800 tracking-tight">
        نبض جوار

    </h2>
      <p class="text-[10px] font-bold text-slate-100 uppercase tracking-[0.2em] mt-1">لوحه التحكم الادارية</p>
<div class="relative max-w-md w-full no-scrollbar">
    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>


    <input type="text"
           id="globalSearch"
           placeholder="ابحث هنا..."
           class="w-full bg-slate-50 border-none pr-10 pl-4 py-3.5 rounded-2xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-[#00bcd4]/20 focus:bg-white transition-all shadow-sm"
    >

<div id="searchResults"
     class="hidden fixed bg-white rounded-2xl shadow-2xl border border-slate-100 z-[9999] overflow-hidden max-h-[400px] overflow-y-auto shadow-cyan-200/50"
     style="width: 260px;"> </div>
</div>    </div>

<a href="#stats" class="nav-link"><i class="fa-solid fa-chart-line"></i> الإحصائيات</a>
<a href="#new-requests" class="nav-link"><i class="fa-solid fa-bell text-orange-400"></i> طلبات جديدة</a>
<a href="#active-nurses" class="nav-link"><i class="fa-solid fa-user-nurse"></i> الممرضات المعتمدات</a>
<a href="#patients" class="nav-link"><i class="fa-solid fa-users"></i> سجل المرضى</a>
<a href="#services-management" class="nav-link"><i class="fa-solid fa-hand-holding-medical"></i> الخدمات الطبية</a>
<form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
            @csrf
            <button type="submit" class="nav-link text-red-600 w-full bg-transparent border-none cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
            </button>
        </form>
    </div>
            @yield('contents')

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('globalSearch');
    const resultsBox = document.getElementById('searchResults');

    if (!searchInput || !resultsBox) return;

    // 1. البحث التلقائي أثناء الكتابة (للتضليل المباشر)
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim().toLowerCase();

        if (searchTerm !== "") {
            document.querySelectorAll('.searchable-item').forEach(item => {
                const itemId = item.getAttribute('data-id');
                if (itemId && itemId.toString().toLowerCase().includes(searchTerm)) {
                    // تضليل الصف عند تطابق النص أثناء الكتابة
                    applyHighlight(item);
                }
            });
        }

        // 2. طلب النتائج من السيرفر
        if (searchTerm.length < 2) {
            resultsBox.classList.add('hidden');
            return;
        }

        fetch(`/search?q=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                let html = '';
                let hasResults = false;

                if (data.users && data.users.length > 0) {
                    hasResults = true;
                    html += `<div class="p-2 bg-slate-50 text-[10px] font-bold text-slate-400 border-b">المستخدمين</div>`;
                    data.users.forEach(user => {
                        const target = (user.Role === 'Patient') ? '#patients' : '#active-nurses';
                        // ملاحظة: أضفنا استدعاء دالة التضليل عند الضغط على الرابط
                        html += `<a href="${target}"
                                    onclick="closeSearch(); highlightRowById('${user.UserID}');"
                                    class="p-3 hover:bg-cyan-50 flex items-center gap-3 border-b border-slate-50 transition-colors block">
                                    <div class="w-7 h-7 rounded-full bg-cyan-100 flex items-center justify-center text-xs text-cyan-600">${user.Role === 'Patient' ? '👤' : '🩺'}</div>
                                    <div><p class="text-sm font-bold text-slate-700">${user.Username}</p></div>
                                 </a>`;
                    });
                }

                // معالجة الخدمات داخل دالة الـ fetch
if (data.services && data.services.length > 0) {
    hasResults = true;
    html += `<div class="p-2 bg-slate-50 text-[10px] font-bold text-slate-400 border-b">الخدمات الطبية</div>`;

    data.services.forEach(service => {
        // قمت هنا بإضافة استدعاء دالة highlightRowById مع الـ ID الخاص بالخدمة
        html += `<a href="#services-management"
                    onclick="closeSearch(); highlightRowById('${service.ServiceID}');"
                    class="p-3 hover:bg-cyan-50 flex items-center gap-3 border-b border-slate-50 transition-colors block">
                    <div class="w-7 h-7 rounded-full bg-orange-100 flex items-center justify-center text-xs text-orange-600">🛠</div>
                    <div><p class="text-sm font-bold text-slate-700">${service.ServiceName}</p></div>
                 </a>`;
    });


                }

                resultsBox.innerHTML = hasResults ? html : `<div class="p-4 text-center text-slate-400 text-xs">لا توجد نتائج</div>`;
                resultsBox.classList.remove('hidden');
            });
    });
});

// دالة التضليل المشتركة (تستخدم عند الكتابة وعند الضغط على الرابط)
function applyHighlight(element) {
    // 1. التوجيه للسطر
    element.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // 2. تضليل الخلايا (td) وليس الصف (tr) فقط لضمان الظهور
    const cells = element.querySelectorAll('td');

    // إضافة كلاس التضليل لكل خلية بداخل السطر
    cells.forEach(cell => {
        cell.style.setProperty('background-color', '#fde047', 'important');
        cell.style.transition = 'background-color 0.5s ease';
    });

    // 3. إعادة اللون للأصل بعد 3 ثواني
    setTimeout(() => {
        cells.forEach(cell => {
            cell.style.removeProperty('background-color');
        });
    }, 3000);
}
// دالة البحث عن الصف وتضليله (تستخدم عند الضغط على النتيجة)
function highlightRowById(id) {
    const targetRow = document.querySelector(`.searchable-item[data-id="${id}"]`);

    if (targetRow) {
        targetRow.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // استخدام الكلاس الأزرق الجديد
        targetRow.classList.add('highlight-blue-force');

        // إزالة الكلاس بعد 3 ثواني
        setTimeout(() => {
            targetRow.classList.remove('highlight-blue-force');
        }, 3000);
    } else {
        console.warn("لم أجد الصف:", id);
    }
}
// دالة إغلاق القائمة
function closeSearch() {
    const resultsBox = document.getElementById('searchResults');
    const searchInput = document.getElementById('globalSearch');
    if (resultsBox) resultsBox.classList.add('hidden');
    if (searchInput) searchInput.value = '';
}


    </script>
</body>
</html>
