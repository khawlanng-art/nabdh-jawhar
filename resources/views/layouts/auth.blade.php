<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta name="google" content="notranslate">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >نبض جوار - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cyan: {
                            500: '#ecfeff',
                            500: '#06b6d4',
                            600: '#0891b2',
                            700: '#0e7490',
                        }
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                        tajawal: ['Tajawal', 'sans-serif'],
                    }
                }
            }
        }
    </script>


    <style>

        :root {
            --primary-cyan: #0e7490;
            --light-cyan: #22d3ee;
            --bg-splash: #cffafe;
        }
        body { font-family: 'Tajawal', sans-serif; margin: 0;/* في ملف الـ CSS الخاص بك */

    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }
        .font-cairo { font-family: 'Cairo', sans-serif;    font-size: 14px;
    }


        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
    </style>


    @yield('extra-style')
</head>

<body  class="@yield('body-class', 'bg-cyan-50')" zoom: 0.50;>
    @yield('content')

    @yield('extra-scripts')

    <script>
      setTimeout(function() {
        var alertElement = document.getElementById('success-alert');
        if (alertElement) {
            // إخفاء العنصر
            alertElement.style.transition = "opacity 0.5s ease";
            alertElement.style.opacity = "0";

            // إزالته نهائياً بعد انتهاء تأثير الاختفاء
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 500);
        }
    }, 4000);
    </script>
</body>

</html>
