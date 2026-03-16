@php
    // 1. تعريف لغة الموقع الحالية
    $isAr = app()->getLocale() == 'ar';

    // 2. استخراج التقنيات بشكل فريد من المصفوفة (Tags) لعمل الفلتر
    $allTags = collect($projects)->pluck('tags')->flatten()->unique()->values();
@endphp

<section id="projects" x-data="{ activeTab: 'all' }" class="py-24 px-6 relative">
    <div class="max-w-7xl mx-auto">

        {{-- رأس القسم - يدعم اللغات الثلاث عبر ملفات الترجمة --}}
        <div class="mb-12 {{ $isAr ? 'text-right' : 'text-left' }}">
            <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-4">
                {{ __('messages.latest') }} <span class="text-primary italic">{{ __('messages.projects_title') }}</span>
            </h2>
            <div class="h-1.5 w-24 bg-primary rounded-full {{ $isAr ? 'ml-auto' : '' }}"></div>
        </div>

        {{-- شريط الفلتر (التصميم الجديد: الكبسولة الزجاجية) --}}
        <div class="flex justify-center mb-16">
            <div
                class="inline-flex flex-wrap items-center justify-center p-2 bg-white/50 dark:bg-slate-900/50 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl">

                {{-- زر الكل - All --}}
                <button @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-primary text-white shadow-lg scale-105' :
                        'text-slate-500 hover:text-primary'"
                    class="relative px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-500">
                    {{ __('messages.all') }}
                </button>

                {{-- أزرار التقنيات الديناميكية المستخرجة من قاعدة البيانات --}}
                @foreach ($allTags as $tag)
                    <button @click="activeTab = '{{ $tag }}'"
                        :class="activeTab === '{{ $tag }}' ? 'bg-primary text-white shadow-lg scale-105' :
                            'text-slate-500 hover:text-primary'"
                        class="px-6 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-500 uppercase">
                        {{ $tag }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- شبكة المشاريع - Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($projects as $project)
                {{-- الفلترة باستخدام Alpine.js --}}
                <div x-show="activeTab === 'all' || {{ json_encode($project->tags) }}.includes(activeTab)"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    class="group relative bg-white dark:bg-slate-900 rounded-[2.5rem] overflow-hidden border border-slate-100 dark:border-slate-800 shadow-xl transition-all duration-500 hover:-translate-y-4">

                    {{-- صورة المشروع مع تأثير الـ Hover --}}
                    <div class="relative h-64 overflow-hidden bg-slate-100 dark:bg-slate-800">
                        @if ($project->thumbnail)
                            <img src="{{ asset($project->thumbnail) }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @endif

                        {{-- طبقة المعاينة عند التمرير --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                            @if ($project->link)
                                <a href="{{ $project->link }}" target="_blank"
                                    class="bg-white text-slate-900 px-6 py-2 rounded-xl font-bold text-sm hover:bg-primary hover:text-white transition-all shadow-lg">
                                    {{ __('messages.preview') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- تفاصيل المشروع (تم إصلاح الخطأ هنا) --}}
                    <div class="p-8 {{ $isAr ? 'text-right' : 'text-left' }}">
                        <h3 class="text-2xl font-black mb-3 dark:text-white">
                            {{ $project->title }}
                        </h3>

                        <p class="text-slate-500 dark:text-slate-400 text-sm font-tajawal mb-6 line-clamp-2">
                            {{ $project->description }}
                        </p>

                        {{-- عرض التقنيات المستخدمة في المشروع --}}
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project->tags as $tag)
                                <span
                                    class="text-[9px] font-bold px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 rounded uppercase tracking-tighter shadow-sm">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
