<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true', mobileMenu: false }"
    :class="{ 'dark': darkMode }">

<head>
    @include('partials.head')
    {{-- Livewire 3 يقوم بحقن الستاين والسكريبت تلقائياً، ولكن لا بأس بتركها --}}
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-500 font-sans antialiased">

    @include('partials.navbar')

    <main class="pt-24 pb-20 overflow-hidden">
        {{-- الأقسام الرئيسية --}}
        @include('partials.hero')

        <div class="space-y-40">
            @include('partials.about')
            @include('partials.skills')
            @include('partials.projects')

            <section id="contact" class="relative py-32 px-6">
                {{-- تأثيرات ضوئية خلفية --}}
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 pointer-events-none">
                    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-[150px]"></div>
                    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/5 rounded-full blur-[150px]">
                    </div>
                </div>

                <div class="max-w-7xl mx-auto">
                    {{-- استدعاء المكون البرمجي --}}
                    <livewire:contact-form />
                </div>
            </section>
        </div>
    </main>

    @include('partials.footer')

    {{-- تم حذف روابط Alpine.js اليدوية لتجنب تعارضها مع Livewire 3 --}}
    @livewireScripts

    <style>
        {{-- أنيميشن الـ Reveal --}} .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</body>

</html>
