<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نبض جوار - الرعاية الصحية المنزلية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
  <style>
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
        </style>
        </head>
<body >
<svg class="w-full h-full  drop-shadow-[0_12px_20px_rgba(6,182,212,0.35)] hover:scale-110 active:scale-95 transition-all duration-300" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
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
          style="transform-origin: 50px 50px;" />

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
</body>
</html>
