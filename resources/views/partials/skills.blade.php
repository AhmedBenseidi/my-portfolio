@php
    $locale = app()->getLocale();
    $isAr = $locale == 'ar';

    // مصفوفة ترجمة الأقسام لضمان ظهورها بالفرنسية والعربية
    $categoryTranslations = [
        'ar' => [
            'backend' => 'تطوير الخلفية',
            'frontend' => 'تطوير الواجهات',
            'mobile' => 'تطبيقات الجوال',
            'tools' => 'الأدوات والبيئة',
            'design' => 'التصميم والجرافيك',
        ],
        'fr' => [
            'backend' => 'Développement Back-end',
            'frontend' => 'Développement Front-end',
            'mobile' => 'Applications Mobiles',
            'tools' => 'Outils & Environnement',
            'design' => 'Design & Graphisme',
        ],
    ];
@endphp

<section id="skills" class="max-w-7xl mx-auto px-6 py-24 reveal" x-intersect="$el.classList.add('active')"
    style="direction: {{ $isAr ? 'rtl' : 'ltr' }};">

    {{-- رأس القسم --}}
    <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="max-w-2xl">
            <h2 class="text-5xl md:text-7xl font-black tracking-tighter dark:text-white uppercase">
                {{ __('messages.skills_title') }}
            </h2>
        </div>

        <div class="hidden md:block text-slate-400 font-medium text-sm {{ $isAr ? 'text-left' : 'text-right' }}">
            <p>{{ __('messages.skills_subtitle') }}</p>
            <p>{{ __('messages.mastery_level') }}</p>
        </div>
    </div>

    {{-- شبكة المهارات --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach ($skills as $category => $items)
            @php
                $categoryKey = strtolower($category);
                $categoryIcons = [
                    'backend' => 'fas fa-layer-group',
                    'frontend' => 'fas fa-wand-magic-sparkles',
                    'mobile' => 'fas fa-mobile-screen-button',
                    'tools' => 'fas fa-terminal',
                    'design' => 'fas fa-palette',
                ];
                $sectionIcon = $categoryIcons[$categoryKey] ?? 'fas fa-cubes';
                $mainColor = $items->first()->color ?? '#2563eb';

                // جلب الترجمة للقسم بناءً على اللغة الحالية
                $displayCategory = $categoryTranslations[$locale][$categoryKey] ?? $category;
            @endphp

            <div
                class="group relative p-1 rounded-[3rem] bg-gradient-to-br from-slate-200 to-transparent dark:from-slate-800 dark:to-transparent hover:from-primary/50 transition-all duration-500">
                <div
                    class="h-full bg-white dark:bg-slate-950 rounded-[2.8rem] p-10 transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-primary/10">

                    {{-- الهيدر الداخلي للكارت --}}
                    <div class="flex items-center justify-between mb-10">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:rotate-12 shadow-inner"
                            style="background-color: {{ $mainColor }}15; color: {{ $mainColor }};">
                            <i class="{{ $sectionIcon }}"></i>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                            {{ $displayCategory }}
                        </span>
                    </div>

                    <div class="space-y-8">
                        @foreach ($items as $skill)
                            <div class="space-y-3">
                                {{-- سطر اسم المهارة والنسبة --}}
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full"
                                            style="background-color: {{ $skill->color }}; box-shadow: 0 0 10px {{ $skill->color }};">
                                        </div>

                                        <span class="text-lg" style="color: {{ $skill->color }};">
                                            @if (str_contains(strtolower($skill->name), 'flutter'))
                                                <svg class="w-5 h-5 inline fill-current" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.314 0L2.3 12L6 15.7L21.684.013h-7.357L14.314 0zm.014 11.072l-6.471 6.457l6.47 6.47h7.37l-6.47-6.47l6.47-6.456h-7.37z" />
                                                </svg>
                                            @elseif (str_contains(strtolower($skill->name), 'tailwind'))
                                                <svg class="w-5 h-5 inline fill-current" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z" />
                                                </svg>
                                            @else
                                                <i class="{{ $skill->icon }} w-5 text-center"></i>
                                            @endif
                                        </span>

                                        <span class="text-sm font-bold tracking-tight dark:text-slate-200">
                                            {{ $skill->name }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400">
                                        {{ $skill->proficiency }}%
                                    </span>
                                </div>

                                {{-- شريط التقدم --}}
                                <div
                                    class="relative h-[4px] w-full bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                    <div class="absolute h-full rounded-full transition-all duration-1000 ease-out opacity-70"
                                        style="width: {{ $skill->proficiency }}%; background-color: {{ $skill->color }}; box-shadow: 0 0 10px {{ $skill->color }}; {{ $isAr ? 'right: 0;' : 'left: 0;' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
