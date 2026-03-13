<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Portfolio | {{ strtoupper(app()->getLocale()) }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    /* منع وميض Alpine.js قبل التحميل */
    [x-cloak] {
        display: none !important;
    }

    /* تحسين أنيميشن الظهور (Scroll Reveal) */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        will-change: transform, opacity;
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* إصلاح مشاكل المحاذاة في العربية */
    [lang="ar"] {
        font-family: 'Tajawal', sans-serif;
    }
</style>
