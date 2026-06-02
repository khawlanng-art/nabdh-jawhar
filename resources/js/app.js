// بيانات الـ Onboarding
const onboardingContent = [
    {
        illustration: Illustrations.Onboarding1,
        title: 'رعاية صحية موثوقة',
        text: 'أهلاً بك في نبض جوار. نوفر لك أفضل خدمات الرعاية الصحية المنزلية بكل سهولة وأمان.',
        bg: 'bg-cyan-50',
    },
    {
        illustration: Illustrations.Onboarding2,
        title: 'نخبة من الممرضين',
        text: 'اعثر على أفضل الممرضين والممرضات بالقرب منك، معتمدين وذوي خبرة عالية لخدمتك.',
        bg: 'bg-teal-50',
    },
    {
        illustration: Illustrations.Onboarding3,
        title: 'احجز بضغطة زر',
        text: 'اطلب خدماتك الصحية بسهولة، تابع طلباتك، واحصل على الرعاية التي تستحقها في منزلك.',
        bg: 'bg-sky-50',
    }
];

let currentStep = 0;

// 1. منطق الـ Splash Screen
function startSplash() {
    const progressText = document.getElementById('progress-text');
    const logoContainer = document.getElementById('logo-container');
    const syringeContainer = document.getElementById('syringe-container');

    logoContainer.innerHTML = Icons.Logo;
    let progress = 0;

    const interval = setInterval(() => {
        progress++;
        progressText.innerText = progress;
        syringeContainer.innerHTML = Icons.Syringe(progress);

        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(showOnboarding, 500);
        }
    }, 25);
}

// 2. الانتقال للـ Onboarding
function showOnboarding() {
    document.getElementById('splash-screen').classList.remove('active');
    document.getElementById('onboarding-screen').classList.add('active');
    updateOnboarding();
}

// 3. تحديث محتوى الـ Onboarding
function updateOnboarding() {
    const content = onboardingContent[currentStep];
    const illContainer = document.getElementById('illustration-container');
    const titleEl = document.getElementById('onboarding-title');
    const textEl = document.getElementById('onboarding-text');
    const bgEl = document.getElementById('onboarding-bg');
    const nextBtn = document.getElementById('next-btn');
    const skipBtn = document.getElementById('skip-btn');

    // تحديث الألوان والخلفية
    bgEl.className = `flex-grow md:flex-grow-0 w-full md:w-1/2 flex items-center justify-center p-8 transition-colors duration-500 ${content.bg}`;

    // إضافة رسوم متحركة عند التغيير
    illContainer.innerHTML = `<div class="animate-slide-fade-in">${content.illustration}</div>`;
    titleEl.parentElement.classList.remove('animate-content-fade-in');
    void titleEl.offsetWidth; // Force reflow
    titleEl.parentElement.classList.add('animate-content-fade-in');

    titleEl.innerText = content.title;
    textEl.innerText = content.text;

    // تحديث النقاط (Dots)
    const dotsContainer = document.getElementById('dots-container');
    dotsContainer.innerHTML = onboardingContent.map((_, i) => `
        <div class="h-2 rounded-full transition-all duration-300 ${currentStep === i ? 'bg-cyan-500 w-8' : 'bg-gray-300 w-2'}"></div>
    `).join('');

    // تحديث الأزرار
    nextBtn.innerText = currentStep === onboardingContent.length - 1 ? 'ابدأ الآن' : 'التالي';
    skipBtn.style.opacity = currentStep === onboardingContent.length - 1 ? '0' : '1';
    skipBtn.style.pointerEvents = currentStep === onboardingContent.length - 1 ? 'none' : 'auto';
}

// أزرار التحكم
document.getElementById('next-btn').addEventListener('click', () => {
    if (currentStep < onboardingContent.length - 1) {
        currentStep++;
        updateOnboarding();
    } else {
        finishOnboarding();
    }
});

document.getElementById('skip-btn').addEventListener('click', finishOnboarding);

function finishOnboarding() {
    document.getElementById('onboarding-screen').classList.remove('active');
    document.getElementById('loading-screen').classList.add('active');
    // هنا يمكن التوجيه لصفحة تسجيل الدخول
    console.log("Onboarding Complete!");
}

// تشغيل عند التحميل
window.onload = startSplash;
