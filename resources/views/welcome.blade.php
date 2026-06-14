<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نبض جوار - الرعاية الصحية المنزلية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <style>
         :root {
            --primary-cyan: #106a83;
            --light-cyan: #279dbb;
            --bg-splash: #b8fff980;
        }

         body { font-family: 'Tajawal', sans-serif; margin: 0;  }
        .font-cairo { font-family: 'Tajawal', sans-serif; }

        #splash-screen {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: var(--bg-splash);
            display: flex; flex-direction: column; align-items: center; justify-content: space-around;
            z-index: 9999;
            transition: transform 0.8s cubic-bezier(0.77, 0, 0.175, 1), opacity 0.5s;
        }
 @keyframes heartbeat {
                0%, 100% { transform: scale(1); }
                25% { transform: scale(1.06); }
                40% { transform: scale(0.98); }
                55% { transform: scale(1.04); }
            }
            @keyframes pulseGlow {
                0%, 100% { opacity: 0.35; filter: blur(2px); }
                50% { opacity: 0.65; filter: blur(4px); }
            }
            @keyframes glassShine {
                0% { transform: translate(-30px, -30px) rotate(45deg); }
                100% { transform: translate(100px, 100px) rotate(45deg); }
            }
            .animated-heart {
                transform-origin: 50px 50px;
                animation: heartbeat 1.6s infinite ease-in-out;
            }
            .animated-glow {
                animation: pulseGlow 2s infinite ease-in-out;
            }
        .logo-circle {
            width: 150px; height: 150px; background: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 15px 35px rgba(14, 116, 144, 0.1);
        }

        .exit-top { transform: translateY(-100%); opacity: 0; }


        @keyframes slide-fade-in {
            from { opacity: 0; transform: translateX(20px) scale(0.98); }
            to { opacity: 1; transform: translateX(0) scale(1); }
        }
        .animate-slide-fade-in { animation: slide-fade-in 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }

        @keyframes slide-up {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }

        @keyframes content-fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-content-fade-in { animation: content-fade-in 0.5s 0.1s ease-out forwards; opacity: 0; }

        @media (min-width: 768px) { .animate-slide-up { animation: none; } }
    </style>
</head>
<body class="bg-gray-100">

    <div id="splash-screen">
        <div style="height: 5vh;"></div>
        <div class="flex flex-col items-center">
            <div>
            <svg class="w-32 h-32 md:w-40 md:h-40 drop-shadow-[0_12px_20px_rgba(6,182,212,0.35)] hover:scale-105 transition-all duration-300" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <defs>


        <linearGradient id="bgGlassGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.95"/>
            <stop offset="30%" stop-color="#E0F7FA" stop-opacity="0.7"/>
            <stop offset="70%" stop-color="#B2EBF2" stop-opacity="0.4"/>
            <stop offset="100%" stop-color="#22D3EE" stop-opacity="0.25"/>
        </linearGradient>

        <linearGradient id="heart3DGradient" x1="20%" y1="0%" x2="80%" y2="100%">
            <stop offset="0%" stop-color="#22D3EE"/>
            <stop offset="30%" stop-color="#06B6D4"/>
            <stop offset="75%" stop-color="#0891B2"/>
            <stop offset="100%" stop-color="#155E75"/>
        </linearGradient>

        <radialGradient id="heartGlow" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#06B6D4" stop-opacity="0.6"/>
            <stop offset="100%" stop-color="#06B6D4" stop-opacity="0"/>
        </radialGradient>

        <filter id="innerShadow" x="-20%" y="-20%" width="140%" height="140%">
            <feOffset dx="2" dy="3"/>
            <feGaussianBlur stdDeviation="2" result="offset-blur"/>
            <feComposite operator="out" in="SourceGraphic" in2="offset-blur" result="inverse"/>
            <feFlood flood-color="#FFFFFF" flood-opacity="0.75" result="color"/>
            <feComposite operator="in" in="color" in2="inverse" result="shadow"/>
            <feComposite operator="over" in="shadow" in2="SourceGraphic"/>
        </filter>

        <clipPath id="circleClip">
            <circle cx="50" cy="50" r="46" />
        </clipPath>
    </defs>

    <circle class="animated-glow" cx="50" cy="50" r="46" fill="url(#heartGlow)" />

    <g filter="url(#innerShadow)">
        <circle cx="50" cy="50" r="46" fill="url(#bgGlassGradient)" stroke="#FFFFFF" stroke-width="1.5"/>
    </g>
    <circle cx="50" cy="50" r="45.2" stroke="#06B6D4" stroke-width="1" stroke-opacity="0.25"/>

    <g clip-path="url(#circleClip)">
        <line x1="0" y1="0" x2="0" y2="150" stroke="url(#bgGlassGradient)" stroke-width="8" opacity="0.4" style="animation: glassShine 3s infinite linear; transform-origin: center;"/>
    </g>

    <g class="animated-heart">
    <path d="M50 82C50 82 23 63 23 42.5C23 29.5 33.25 20.75 44.75 24.75C47.875 26 50 30 50 30C50 30 52.125 26 55.25 24.75C66.75 20.75 77 29.5 77 42.5C77 63 50 82 50 82Z"
          fill="#0891B2"
          fill-opacity="0.25"
          transform="translate(0, 4) scale(0.98)"
          style="transform-origin: 50px 50px;"/>

    <path d="M50 82C50 82 23 63 23 42.5C23 29.5 33.25 20.75 44.75 24.75C47.875 26 50 30 50 30C50 30 52.125 26 55.25 24.75C66.75 20.75 77 29.5 77 42.5C77 63 50 82 50 82Z"
          fill="url(#heart3DGradient)"
          stroke="#FFFFFF"
          stroke-width="1"
          stroke-opacity="0.5"/>

    <path d="M33 54H40.5L44.5 47L54.5 60L58.5 54H67"
          stroke="#FFFFFF"
          stroke-width="3.5"
          stroke-linecap="round"
          stroke-linejoin="round"
          style="filter: drop-shadow(0px 0px 5px rgba(255,255,255,1)) drop-shadow(0px 3px 6px rgba(6,182,212,0.6));"/>

    <circle cx="44.5" cy="47" r="1.5" fill="#FFFFFF" style="filter: drop-shadow(0px 0px 4px #FFFFFF);"/>
</g>
</svg>
            </div>
                 <div style="height: 3vh;"></div>
<div class="flex flex-col items-center text-center -mt-2">
    <h1 class="text-4xl font-extrabold font-Tajawal leading-none"
        style="
            color: #0e7490;
            /* تأثير 3D: ظل علوي فاتح وبروز سفلي داكن */
            text-shadow:
                1px 1px 0px #ffffff,
                2px 2px 0px #a3c9d1,
                3px 3px 0px #8eb4bd,
                4px 4px 0px #799fa7,
                5px 5px 10px rgba(0,0,0,0.2);
            letter-spacing: -0.5px;
        ">
        نبض جوار
    </h1>

    <p class="mt-6 text-2x1 font-bold font-Tajawal"
       style="
            color:#ffffff ;

            text-shadow: 1px 1px 0px #0a0a0a ;
       ">
        رعايتكم تهمنا
    </p>
</div>
        </div>

        <div class="flex flex-col items-center">
            <div class="w-[50px] h-[100px] mb-4">
                <svg viewBox="0 0 60 120" width="100%" height="100%">
                    <rect x="15" y="20" width="30" height="70" rx="3" fill="white" fill-opacity="0.5" stroke="var(--light-cyan)" stroke-width="2.5"/>
                    <rect id="liquid" x="17.5" y="87.5" width="25" height="0" fill="var(--light-cyan)" rx="1.5" />
                    <line x1="30" y1="90" x2="30" y2="115" stroke="var(--primary-cyan)" stroke-width="2.5" stroke-linecap="round"/>
                    <rect x="18" y="5" width="24" height="4" fill="var(--primary-cyan)" rx="1"/>
                    <rect x="27.5" y="9" width="5" height="11" fill="var(--primary-cyan)"/>
                </svg>
            </div>
            <p class="text-xl font-bold text-[#0e7490] font-cairo"><span id="counter">0</span>%</p>
        </div>
    </div>

    <div id="onboarding-screen" class="flex flex-col h-screen transition-colors duration-500 opacity-0">
        <div class="w-full h-full flex flex-col md:flex-row bg-white">
            <div id="illustration-bg" class="flex-grow md:flex-grow-0 w-full md:w-1/2 flex items-center justify-center p-8 md:p-8 lg:p-12 overflow-hidden transition-colors duration-500">
                <div id="illustration-container" class="w-full max-w-md"></div>
            </div>

            <div class="flex-shrink-0 bg-white rounded-t-3xl md:rounded-none md:w-1/2 p-6 pt-8 md:p-8 lg:p-16 text-center shadow-2xl md:shadow-none animate-slide-up flex flex-col justify-center">
                <div id="text-container">
                    <h1 id="title" class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-4"></h1>
                    <p id="description" class="text-gray-500 text-base md:text-lg leading-relaxed mb-8 md:mb-12 min-h-[4.5rem] md:min-h-[5rem]"></p>
                </div>

                <div id="indicators" class="flex justify-center items-center gap-2 mb-8 md:mb-12"></div>
<div class="flex items-center gap-4 max-w-sm mx-auto w-full">
    <a href="{{ route('Home') }}" class="text-gray-500 font-semibold px-4 py-3 hover:bg-gray-100 rounded-lg transition-opacity">
        تخطي
    </a>

    <button id="next-btn" class="flex-grow bg-cyan-500 text-white py-3.5 rounded-xl font-bold text-lg shadow-md shadow-cyan-500/30 hover:bg-cyan-600 transition">
        التالي
    </button>
</div>
            </div>
        </div>
    </div>

    <script>


        const Illustrations = {
            Onboarding1: `<svg viewBox="0 0 300 250" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="250" rx="20" fill="#F0FDFA"/><path d="M0 230 C 50 240, 250 240, 300 230 V 250 H 0 Z" fill="#A5F3FC"/><path d="M100 230 V 80 C 100 68.9543 108.954 60 120 60 H 180 C 191.046 60 200 68.9543 200 80 V 230" fill="#FFFFFF"/><rect x="180" y="140" width="8" height="8" rx="4" fill="#CFFAFE"/><g transform="translate(160, 130)"><rect y="20" width="50" height="70" rx="25" fill="#FFFFFF" stroke="#E0F2FE" strokeWidth="4"/><circle cx="25" cy="10" r="10" fill="#A5F3FC"/><path d="M22 10 H 28 M 25 7 V 13" stroke="#0891B2" stroke-width="2" stroke-linecap="round"/><g transform="translate(-30, 30)"><rect width="25" height="20" rx="5" fill="#0891B2"/><rect x="5" y="-5" width="15" height="5" rx="2.5" fill="#06B6D4"/><path d="M8 7 H 17 M 12.5 3 V 11" stroke="white" stroke-width="1.5" stroke-linecap="round"/></g></g><path d="M230 70 C 220 60, 200 65, 200 80 C 200 100, 230 120, 230 120 C 230 120, 260 100, 260 80 C 260 65, 240 60, 230 70Z" fill="#F472B6"/></svg>`,
            Onboarding2: `<svg viewBox="0 0 300 250" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="250" rx="20" fill="#F0FDF4"/><path d="M50 250 C 100 200, 200 200, 250 250 Z" fill="#D1FAE5"/><g transform="translate(120, 40)"><rect y="30" width="60" height="120" rx="30" fill="white" stroke="#A7F3D0" stroke-width="4"/><circle cx="30" cy="15" r="15" fill="#A7F3D0"/><rect x="-10" y="60" width="30" height="40" rx="5" fill="#E0F2FE"/><rect x="-15" y="55" width="40" height="5" rx="2.5" fill="#BFDBFE"/></g><g transform="translate(50, 60)"><path d="M25 0 l7.73 15.6 17.27 2.5 -12.5 12.18 2.95 17.22 -15.45 -8.12 -15.45 8.12 2.95 -17.22 -12.5 -12.18 17.27 -2.5Z" fill="#FBBF24"/></g><g transform="translate(200, 80)"><rect width="50" height="60" rx="5" fill="#DBEAFE"/><path d="M10 15 H 40 M 10 25 H 40 M 10 35 H 30" stroke="#60A5FA" stroke-width="2" stroke-linecap="round"/><circle cx="25" cy="48" r="6" fill="#60A5FA"/></g><g transform="translate(70, 160)"><path d="M20 10 C15 5 5 10 5 17 C5 27 20 32 20 32 C20 32 35 27 35 17 C35 10 25 5 20 10Z" fill="#F472B6"/></svg>`,
            Onboarding3: `<svg viewBox="0 0 300 250" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="250" rx="20" fill="#EFF6FF"/><g transform="translate(150, 40)"><rect width="110" height="170" rx="20" fill="white" stroke="#BFDBFE" stroke-width="4"/><rect x="5" y="5" width="100" height="160" rx="15" fill="#F0FDFA"/><rect x="40" y="10" width="30" height="4" rx="2" fill="#BFDBFE"/></g><path d="M180 120 C 170 110, 155 115, 150 130 L 140 200 H 170 Z" fill="#A5F3FC" stroke="#0891B2" stroke-width="3"/><rect x="170" y="140" width="70" height="30" rx="15" fill="#06B6D4"/><text x="205" y="160" text-anchor="middle" fill="white" font-weight="bold" font-size="12">احجز الآن</text><path d="M150 130 C 100 130, 90 80, 50 80" stroke="#0891B2" stroke-width="3" fill="none" stroke-dasharray="5 5" stroke-linecap="round"/><g transform="translate(30, 90)"><circle cx="15" cy="10" r="10" fill="#A5F3FC"/><rect y="20" width="30" height="40" rx="15" fill="white"/><g transform="translate(25, 25)"><rect width="15" height="12" rx="3" fill="#0891B2"/><rect x="4" y="-3" width="7" height="3" rx="1.5" fill="#06B6D4"/></g></g></svg>`
        };

        const onboardingContent = [
            { illustration: Illustrations.Onboarding1, title: 'رعاية صحية موثوقة', text: 'أهلاً بك في نبض جوار. نوفر لك أفضل خدمات الرعاية الصحية المنزلية بكل سهولة وأمان.', bg: 'bg-cyan-50' },
            { illustration: Illustrations.Onboarding2, title: 'نخبة من الممرضين', text: 'اعثر على أفضل الممرضين والممرضات بالقرب منك، معتمدين وذوي خبرة عالية لخدمتك.', bg: 'bg-teal-50' },
            { illustration: Illustrations.Onboarding3, title: 'احجز بضغطة زر', text: 'اطلب خدماتك الصحية بسهولة، تابع طلباتك، واحصل على الرعاية التي تستحقها في منزلك.', bg: 'bg-sky-50' }
        ];

        let step = 0;
        const splash = document.getElementById('splash-screen');
        const counter = document.getElementById('counter');
        const liquid = document.getElementById('liquid');
        const onboarding = document.getElementById('onboarding-screen');

        const illuContainer = document.getElementById('illustration-container');
        const illuBg = document.getElementById('illustration-bg');
        const titleEl = document.getElementById('title');
        const descEl = document.getElementById('description');
        const indicatorsEl = document.getElementById('indicators');
        const nextBtn = document.getElementById('next-btn');

        const textContainer = document.getElementById('text-container');


        document.addEventListener('DOMContentLoaded', () => {
            let progress = 0;
            const interval = setInterval(() => {
                if (progress >= 100) {
                    clearInterval(interval);
                    splash.classList.add('exit-top');
                    onboarding.classList.replace('opacity-0', 'opacity-100');
                    render();
                } else {
                    progress++;
                    counter.textContent = progress;
                    const currentHeight = (progress / 100) * 65;
                    liquid.setAttribute('height', currentHeight);
                    liquid.setAttribute('y', 87.5 - currentHeight);
                }
            }, 20);
        });


        function render() {
            const content = onboardingContent[step];


            illuBg.className = `flex-grow md:flex-grow-0 w-full md:w-1/2 flex items-center justify-center p-8 md:p-8 lg:p-12 overflow-hidden transition-colors duration-500 ${content.bg}`;
            illuContainer.innerHTML = content.illustration;
            illuContainer.classList.remove('animate-slide-fade-in');
            void illuContainer.offsetWidth;
            illuContainer.classList.add('animate-slide-fade-in');


            titleEl.innerText = content.title;
            descEl.innerText = content.text;
            textContainer.classList.remove('animate-content-fade-in');
            void textContainer.offsetWidth;
            textContainer.classList.add('animate-content-fade-in');


            indicatorsEl.innerHTML = onboardingContent.map((_, i) => `
                <div class="h-2 rounded-full transition-all duration-300 ${step === i ? 'bg-cyan-500 w-8' : 'bg-gray-300 w-2'}"></div>
            `).join('');


          nextBtn.innerText = step === onboardingContent.length - 1 ? 'ابدأ الآن' : 'التالي';

        }


   nextBtn.addEventListener('click', () => {
    if (step < onboardingContent.length - 1) {
        step++;
        render();
    } else {
        // التوجيه المباشر لصفحة الـ home
        window.location.href = "{{ route('Home') }}";
    }
});


    </script>
</body>
</html>
