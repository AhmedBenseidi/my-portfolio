    <nav
        class="fixed w-full top-0 z-50 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 font-bold">
        <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">
            <div class="text-2xl font-black text-primary uppercase tracking-tighter">PORTFOLIO<span
                    class="text-slate-400">.</span></div>

            <div class="hidden md:flex items-center gap-10">
                <div class="flex items-center gap-8">
                    <a href="#hero"
                        class="hover:text-primary transition-colors duration-300">{{ __('messages.nav_home') }}</a>
                    <a href="#about"
                        class="hover:text-primary transition-colors duration-300">{{ app()->getLocale() == 'ar' ? 'من أنا' : (app()->getLocale() == 'fr' ? 'À propos' : 'About') }}</a>
                    <a href="#projects"
                        class="hover:text-primary transition-colors duration-300">{{ __('messages.nav_projects') }}</a>
                    <a href="#contact"
                        class="hover:text-primary transition-colors duration-300">{{ __('messages.nav_contact') }}</a>
                </div>

                <div class="flex items-center gap-4 border-s ps-6 border-slate-200 dark:border-slate-700">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="uppercase text-xs font-bold bg-slate-100 dark:bg-slate-800 px-3 py-2 rounded-lg border dark:border-slate-700 flex items-center gap-1">
                            {{ app()->getLocale() }} <i class="fas fa-chevron-down text-[10px]"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="absolute mt-2 w-32 bg-white dark:bg-slate-800 border dark:border-slate-700 rounded-xl shadow-2xl overflow-hidden z-[100]">
                            <a href="{{ route('lang.switch', 'ar') }}"
                                class="block px-4 py-2 hover:bg-primary hover:text-white transition">العربية</a>
                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-4 py-2 hover:bg-primary hover:text-white transition">English</a>
                            <a href="{{ route('lang.switch', 'fr') }}"
                                class="block px-4 py-2 hover:bg-primary hover:text-white transition">Français</a>
                        </div>
                    </div>
                    <button @click="darkMode = !darkMode; localStorage.setItem('dark', darkMode)"
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-primary/10 transition">
                        <span x-show="!darkMode">🌙</span><span x-show="darkMode" x-cloak>☀️</span>
                    </button>
                </div>
            </div>

            <div class="md:hidden flex items-center gap-3">
                <button @click="darkMode = !darkMode; localStorage.setItem('dark', darkMode)"
                    class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800">
                    <span x-show="!darkMode">🌙</span><span x-show="darkMode" x-cloak>☀️</span>
                </button>
                <button @click="mobileMenu = !mobileMenu" class="p-2 text-slate-600 dark:text-slate-300">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden bg-white dark:bg-slate-900 border-t dark:border-slate-800 shadow-xl transition-all">
            <div class="flex flex-col p-6 gap-4 {{ app()->getLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                <a href="#hero" @click="mobileMenu = false"
                    class="text-lg font-bold hover:text-primary transition">{{ __('messages.nav_home') }}</a>
                <a href="#about" @click="mobileMenu = false"
                    class="text-lg font-bold hover:text-primary transition">{{ app()->getLocale() == 'ar' ? 'من أنا' : (app()->getLocale() == 'fr' ? 'À propos' : 'About') }}</a>
                <a href="#projects" @click="mobileMenu = false"
                    class="text-lg font-bold hover:text-primary transition">{{ __('messages.nav_projects') }}</a>
                <a href="#contact" @click="mobileMenu = false"
                    class="text-lg font-bold hover:text-primary transition">{{ __('messages.nav_contact') }}</a>

                <div class="flex gap-2 pt-4 border-t dark:border-slate-800 font-black">
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="flex-1 text-center px-4 py-2 {{ app()->getLocale() == 'ar' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-slate-800' }} rounded-lg">AR</a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="flex-1 text-center px-4 py-2 {{ app()->getLocale() == 'en' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-slate-800' }} rounded-lg">EN</a>
                    <a href="{{ route('lang.switch', 'fr') }}"
                        class="flex-1 text-center px-4 py-2 {{ app()->getLocale() == 'fr' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-slate-800' }} rounded-lg">FR</a>
                </div>
            </div>
        </div>
    </nav>
