@php
    // 1. تعريف لغة الموقع
    $locale = app()->getLocale();
    $isAr = $locale == 'ar';

    // 2. ضبط الأحجام بناءً على اللغة لضمان تناسق التصميم
    $titleSize = $isAr ? 'text-5xl md:text-7xl' : 'text-4xl md:text-6xl';
    $inputSize = $isAr ? 'text-2xl md:text-3xl' : 'text-xl md:text-2xl';
    $labelSize = $isAr ? 'text-sm font-bold tracking-normal' : 'text-[10px] font-black tracking-[0.2em]';
@endphp

<div class="relative w-full max-w-6xl mx-auto py-8 font-tajawal">

    {{-- رسالة النجاح بتصميم عائم (تختفي تلقائياً) --}}
    @if ($successMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-6">
            <div
                class="bg-primary/90 backdrop-blur-md text-white p-4 rounded-2xl shadow-2xl flex items-center justify-between border border-white/20">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span class="font-bold">{{ $successMessage }}</span>
                </div>
                <button @click="show = false" class="opacity-50 hover:opacity-100"><i class="fas fa-times"></i></button>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="relative">
        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[3rem] p-8 md:p-16 lg:p-20 shadow-xl">

            {{-- مؤشر جاري الإرسال (Loading Spinner) --}}
            <div wire:loading wire:target="submit"
                class="absolute inset-0 z-50 bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm flex items-center justify-center">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                    <p class="font-bold text-primary">{{ __('messages.sending_status') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
                {{-- القسم الأيسر: العنوان والبيانات --}}
                <div class="lg:col-span-6 space-y-12">
                    <div class="relative {{ $isAr ? 'text-right' : 'text-left' }}">
                        <span class="{{ $labelSize }} text-primary mb-4 block opacity-80 uppercase italic">
                            {{ __('messages.contact_title') }}
                        </span>
                        <h2
                            class="{{ $titleSize }} font-black text-slate-900 dark:text-white leading-[1.1] tracking-tighter uppercase">
                            {{-- استخدام الترجمة للمفتاح المحدث مع دعم HTML --}}
                            {!! $locale == 'ar'
                                ? 'لنعمل <span class="text-primary block">معاً.</span>'
                                : ($locale == 'fr'
                                    ? 'Restons <span class="text-primary block">en Contact.</span>'
                                    : 'Get in <br> <span class="text-primary">Touch.</span>') !!}
                        </h2>
                    </div>

                    <div class="space-y-8">
                        {{-- حقل الاسم --}}
                        <div class="group relative {{ $isAr ? 'text-right' : 'text-left' }}">
                            <label
                                class="{{ $labelSize }} text-slate-400 mb-2 block transition-colors group-focus-within:text-primary uppercase">
                                {{ __('messages.name_placeholder') }}
                            </label>
                            <input type="text" wire:model="name"
                                class="w-full bg-transparent border-b-2 @error('name') border-red-500 @else border-slate-100 dark:border-slate-800 @enderror focus:border-primary outline-none py-3 {{ $inputSize }} font-bold dark:text-white transition-all">
                            @error('name')
                                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- حقل الإيميل --}}
                        <div class="group relative {{ $isAr ? 'text-right' : 'text-left' }}">
                            <label
                                class="{{ $labelSize }} text-slate-400 mb-2 block transition-colors group-focus-within:text-primary uppercase">
                                {{ __('messages.email_placeholder') }}
                            </label>
                            <input type="email" wire:model="email"
                                class="w-full bg-transparent border-b-2 @error('email') border-red-500 @else border-slate-100 dark:border-slate-800 @enderror focus:border-primary outline-none py-3 {{ $inputSize }} font-bold dark:text-white transition-all">
                            @error('email')
                                <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- القسم الأيمن: نص الرسالة وزر الإرسال --}}
                <div class="lg:col-span-6 flex flex-col justify-between">
                    <div class="relative {{ $isAr ? 'text-right' : 'text-left' }}">
                        <label class="{{ $labelSize }} text-slate-400 mb-4 block uppercase">
                            {{ __('messages.message_placeholder') }}
                        </label>
                        <textarea wire:model="message"
                            class="w-full h-48 lg:h-64 bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-6 {{ $isAr ? 'text-xl' : 'text-lg' }} font-medium dark:text-white outline-none focus:ring-2 @error('message') ring-red-500/20 border-red-500 @else ring-primary/20 border-slate-100 dark:border-slate-800 @enderror transition-all resize-none border"></textarea>
                        @error('message')
                            <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-10">
                        <button type="submit" wire:loading.attr="disabled"
                            class="group relative w-full h-20 bg-slate-950 dark:bg-white text-white dark:text-slate-950 rounded-2xl {{ $isAr ? 'text-2xl font-bold' : 'text-sm font-black uppercase tracking-[0.2em]' }} flex items-center justify-center gap-4 transition-all hover:shadow-xl active:scale-[0.98] disabled:opacity-50">

                            <span wire:loading.remove wire:target="submit">{{ __('messages.send_button') }}</span>
                            <span wire:loading wire:target="submit">{{ $isAr ? 'انتظر...' : 'WAIT...' }}</span>

                            <i wire:loading.remove wire:target="submit"
                                class="fas fa-paper-plane {{ $isAr ? 'text-lg' : 'text-xs' }} transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
