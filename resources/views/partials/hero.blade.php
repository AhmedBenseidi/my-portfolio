@php $isAr = app()->getLocale() == 'ar'; @endphp

<section class="relative min-h-[80vh] flex items-center justify-center px-6 overflow-hidden">

    {{-- رموز برمجية عائمة في الخلفية --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03] dark:opacity-[0.05] font-mono text-sm select-none">
        <div class="absolute top-10 left-10 animate-bounce"><span>
                << /span>div<span>></span></div>
        <div class="absolute top-40 right-20 rotate-12">function()</div>
        <div class="absolute bottom-20 left-1/4 -rotate-12">axios.get()</div>
        <div class="absolute top-1/2 right-1/3 rotate-45">&#64;stack</div>
        <div class="absolute bottom-10 right-10 uppercase tracking-widest">Laravel v12</div>
    </div>

    <div class="relative z-10 text-center">
        {{-- العنوان بتأثير الكتابة والتدرج --}}
        <h1
            class="hero-text animate-gradient bg-clip-text text-transparent bg-gradient-to-r from-primary via-purple-500 to-primary text-4xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter">
            <span class="typewriter inline-block border-primary">
                {{-- نستخدم المفتاح الجديد الموحد --}}
                {{ __('messages.about_title_simple') }}
            </span>
        </h1>

        <p
            class="mt-8 text-slate-600 dark:text-slate-400 text-lg md:text-2xl max-w-3xl mx-auto leading-relaxed font-tajawal">
            {{-- جلب الوصف من ملف اللغة --}}
            {{ __('messages.hero_desc') }}
        </p>

        {{-- أزرار تفاعلية --}}
        <div class="mt-12 flex flex-wrap justify-center gap-6">
            <a href="#projects"
                class="px-8 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl font-bold transition-all hover:scale-105 active:scale-95 shadow-xl">
                {{ __('messages.nav_projects') }}
            </a>
            <a href="#contact"
                class="px-8 py-4 border-2 border-slate-200 dark:border-slate-800 rounded-2xl font-bold transition-all hover:bg-slate-100 dark:hover:bg-slate-800">
                {{ __('messages.nav_contact') }}
            </a>
        </div>
    </div>

    {{-- دائرة ضوئية خلفية --}}
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[120px] -z-10">
    </div>
</section>
