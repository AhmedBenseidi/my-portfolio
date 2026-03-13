<section id="about" class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-16 items-center reveal"
    x-intersect="$el.classList.add('active')">

    {{-- منطقة الصورة --}}
    <div
        class="relative group flex justify-center order-2 {{ app()->getLocale() == 'ar' ? 'md:order-1' : 'md:order-2' }}">
        <div
            class="absolute -inset-4 bg-primary/20 rounded-full blur-3xl group-hover:bg-primary/30 transition duration-1000">
        </div>

        {{-- تعديل مصدر الصورة هنا --}}
        <img src="{{ asset('images/ahmed-profile.jpg') }}" alt="Ahmed Benseidi"
            class="relative rounded-[3rem] w-72 h-72 md:w-80 md:h-80 object-cover border-8 border-white dark:border-slate-800 shadow-2xl rotate-3 group-hover:rotate-0 transition duration-500">
    </div>

    {{-- منطقة النصوص --}}
    <div class="space-y-6 order-1 {{ app()->getLocale() == 'ar' ? 'md:order-2 text-right' : 'md:order-1 text-left' }}">
        <h2 class="text-4xl font-black uppercase tracking-tighter italic">{!! __('messages.about_title') !!}</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
            {{ __('messages.about_desc') }}
        </p>

        <div class="pt-4 flex {{ app()->getLocale() == 'ar' ? 'justify-end md:justify-start' : 'justify-start' }}">
            <a href="{{ route('cv.download', ['locale' => app()->getLocale()]) }}" target="_blank"
                class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-bold transition-transform hover:scale-105 shadow-lg shadow-primary/20">
                <i class="fas fa-download"></i>
                {{ __('messages.download_cv') }}
            </a>
        </div>
    </div>
</section>
