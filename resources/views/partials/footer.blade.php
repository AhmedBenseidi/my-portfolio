@php
    $locale = app()->getLocale();
    $isAr = $locale == 'ar';
@endphp

<footer
    class="relative bg-white dark:bg-slate-950 pt-20 pb-10 border-t border-slate-100 dark:border-slate-900 overflow-hidden"
    style="direction: {{ $isAr ? 'rtl' : 'ltr' }};">

    {{-- لمسة جمالية علوية --}}
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-primary/50 to-transparent">
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">

            {{-- القسم الأول: التعريف الشخصي --}}
            <div class="md:col-span-5 space-y-6 {{ $isAr ? 'text-right' : 'text-left' }}">
                <a href="#" class="text-3xl font-black tracking-tighter text-slate-900 dark:text-white uppercase">
                    Ahmed<span class="text-primary italic">.dev</span>
                </a>
                <p class="text-slate-500 dark:text-slate-400 font-tajawal max-w-sm leading-relaxed">
                    @if ($locale == 'ar')
                        مبرمج ومطور برمجيات متخصص في إطار عمل Laravel وتطبيقات Flutter. أركز على بناء حلول رقمية مبتكرة
                        وعالية الأداء تلبي احتياجات المستخدمين.
                    @elseif($locale == 'fr')
                        Développeur Full-Stack expert en Laravel et Flutter. Je m'efforce de transformer des concepts
                        complexes en solutions numériques fluides et performantes.
                    @else
                        Full-Stack Developer specialized in Laravel and Flutter. Passionate about building robust,
                        scalable, and user-centric digital solutions.
                    @endif
                </p>

                {{-- أزرار التواصل الاجتماعي المحدثة بجميع روابطك --}}
                <div class="flex items-center gap-4 {{ $isAr ? 'justify-start' : 'justify-start' }}">
                    <a href="https://github.com/AhmedBenseidi" target="_blank" title="GitHub"
                        class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-xl transition-all hover:bg-primary hover:text-white hover:-translate-y-1 shadow-sm">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://linkedin.com/in/ahmed-benseidi-b67543387" target="_blank" title="LinkedIn"
                        class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-xl transition-all hover:bg-primary hover:text-white hover:-translate-y-1 shadow-sm">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="mailto:ahmed.benseidi.it@gmail.com" title="Email"
                        class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-xl transition-all hover:bg-primary hover:text-white hover:-translate-y-1 shadow-sm">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            {{-- القسم الثاني: روابط التنقل --}}
            <div class="md:col-span-3 space-y-6 {{ $isAr ? 'text-right' : 'text-left' }}">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] text-slate-900 dark:text-white">
                    {{ $locale == 'ar' ? 'روابط سريعة' : ($locale == 'fr' ? 'Liens Rapides' : 'Quick Links') }}
                </h4>
                <ul class="space-y-4 font-medium text-sm">
                    <li><a href="#projects"
                            class="text-slate-500 hover:text-primary transition-colors">{{ __('messages.nav_projects') ?? 'Projects' }}</a>
                    </li>
                    <li><a href="#skills"
                            class="text-slate-500 hover:text-primary transition-colors">{{ __('messages.skills_title') ?? 'Skills' }}</a>
                    </li>
                    <li><a href="#contact"
                            class="text-slate-500 hover:text-primary transition-colors">{{ __('messages.nav_contact') ?? 'Contact' }}</a>
                    </li>
                </ul>
            </div>

            {{-- القسم الثالث: معلومات التواصل المباشر --}}
            <div class="md:col-span-4 space-y-6 {{ $isAr ? 'text-right' : 'text-left' }}">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] text-slate-900 dark:text-white">
                    {{ $locale == 'ar' ? 'معلومات الاتصال' : ($locale == 'fr' ? 'Contactez-moi' : 'Get in Touch') }}
                </h4>
                <div class="space-y-5">
                    <a href="mailto:ahmed.benseidi.it@gmail.com" class="flex items-center gap-4 group">
                        <div
                            class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center transition-colors group-hover:bg-primary group-hover:text-white">
                            <i class="fas fa-at text-xs"></i>
                        </div>
                        <span
                            class="text-slate-500 dark:text-slate-400 text-sm font-medium transition-colors group-hover:text-primary break-all">ahmed.benseidi.it@gmail.com</span>
                    </a>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                            <i class="fas fa-location-dot text-xs"></i>
                        </div>
                        <span class="text-slate-500 dark:text-slate-400 text-sm font-medium">M'Sila, Algeria</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- التوقيع النهائي وحقوق النشر --}}
        <div
            class="pt-10 border-t border-slate-100 dark:border-slate-900 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                © {{ date('Y') }} Ahmed.dev.
                @if ($locale == 'ar')
                    جميع الحقوق محفوظة
                @elseif($locale == 'fr')
                    Tous droits réservés
                @else
                    All rights reserved
                @endif.
            </p>

            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 uppercase tracking-tighter">
                <span>{{ $isAr ? 'صُنع بكل' : 'Crafted with' }}</span>
                <i class="fas fa-heart text-red-500 animate-pulse"></i>
                <span>{{ $isAr ? 'في الجزائر' : 'in Algeria' }}</span>
            </div>
        </div>
    </div>
</footer>
