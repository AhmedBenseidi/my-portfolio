@php
    $locale = app()->getLocale();
    $isAr = $locale == 'ar';
    $isFr = $locale == 'fr';
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isAr ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - Ahmed Benseidi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .btn-download {
            background-color: #2563eb !important;
            color: white !important;
            padding: 14px 28px !important;
            border-radius: 12px !important;
            font-weight: bold !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        body {
            font-family: {{ $isAr ? "'Tajawal', sans-serif" : "'Plus Jakarta Sans', sans-serif" }};
            -webkit-print-color-adjust: exact;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                padding: 0 !important;
            }

            .cv-card {
                box-shadow: none !important;
                border: 1px solid #eee !important;
                border-radius: 0 !important;
            }
        }
    </style>
</head>

<body class="bg-slate-100 p-4 md:p-12">

    <div
        class="max-w-4xl mx-auto mb-8 no-print flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
            <span class="text-sm font-bold text-slate-600">
                {{ $isAr ? 'جاهز للحفظ كـ PDF' : ($isFr ? 'Prêt pour PDF' : 'Ready to Save') }}
            </span>
        </div>
        <button onclick="window.print()" class="btn-download hover:opacity-90 transition-all">
            <i class="fas fa-file-pdf text-xl"></i>
            {{ $isAr ? 'حفظ السيرة الذاتية' : ($isFr ? 'Enregistrer le CV' : 'Save CV') }}
        </button>
    </div>

    <div class="max-w-4xl mx-auto bg-white cv-card shadow-2xl rounded-[2.5rem] overflow-hidden border border-slate-100">

        {{-- الهيدر العلوي الأسود --}}
        <div class="bg-slate-950 p-12 text-white relative">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div>
                    <h1 class="text-5xl font-black tracking-tighter uppercase leading-none">Ahmed<br><span
                            class="text-blue-500 italic">Benseidi</span></h1>
                    <p class="text-slate-400 font-bold mt-4 tracking-widest uppercase text-xs">
                        {{ $isAr ? 'مطور تطبيقات ويب وموبايل متكامل (Full-Stack)' : ($isFr ? 'Développeur Full-Stack Web & Mobile' : 'Full-Stack Web & Mobile Developer') }}
                    </p>
                </div>
                <div
                    class="space-y-3 text-sm font-medium border-{{ $isAr ? 'r' : 'l' }}-2 border-blue-500 {{ $isAr ? 'pr' : 'pl' }}-6">
                    <div class="flex items-center gap-3"><i class="fas fa-envelope text-blue-500 w-5 text-center"></i>
                        ahmed.benseidi.it@gmail.com</div>
                    <div class="flex items-center gap-3"><i
                            class="fab fa-linkedin-in text-blue-500 w-5 text-center"></i>
                        linkedin.com/in/ahmed-benseidi-b67543387</div>
                    <div class="flex items-center gap-3"><i class="fab fa-github text-blue-500 w-5 text-center"></i>
                        github.com/AhmedBenseidi</div>
                    <div class="flex items-center gap-3"><i
                            class="fas fa-location-dot text-blue-500 w-5 text-center"></i> M'Sila, Algeria</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12">

            {{-- العمود الجانبي --}}
            <div class="md:col-span-4 bg-slate-50/50 p-10 border-{{ $isAr ? 'l' : 'r' }} border-slate-100">
                <section class="mb-12">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-blue-600 mb-6">
                        {{ $isAr ? 'التقنيات' : 'Tech Stack' }}</h3>
                    <div class="space-y-4">
                        @foreach ([['Laravel', 90], ['Flutter', 85], ['PHP', 90], ['MySQL', 80], ['Tailwind', 95]] as $skill)
                            <div class="space-y-1">
                                <div class="flex justify-between text-[10px] font-bold uppercase">
                                    <span>{{ $skill[0] }}</span><span>{{ $skill[1] }}%</span>
                                </div>
                                <div class="h-1 w-full bg-slate-200 rounded-full">
                                    <div class="h-full bg-slate-900 rounded-full" style="width: {{ $skill[1] }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-blue-600 mb-6">
                        {{ $isAr ? 'اللغات' : 'Languages' }}</h3>
                    <div class="space-y-3 text-sm font-bold">
                        <div class="flex justify-between"><span>{{ $isAr ? 'العربية' : 'Arabic' }}</span> <span
                                class="text-blue-500">Native</span></div>
                        <div class="flex justify-between"><span>{{ $isAr ? 'الإنجليزية' : 'English' }}</span> <span
                                class="text-slate-400">Professional</span></div>
                        <div class="flex justify-between"><span>{{ $isAr ? 'الفرنسية' : 'French' }}</span> <span
                                class="text-slate-400">Fluent</span></div>
                    </div>
                </section>
            </div>

            {{-- العمود الرئيسي --}}
            <div class="md:col-span-8 p-10 md:p-12 space-y-12">
                <section>
                    <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-blue-100 pb-2 inline-block">
                        {{ $isAr ? 'الملخص المهني' : 'Profile' }}</h2>
                    <p class="text-slate-600 leading-relaxed text-sm italic">
                        {{ $isAr
                            ? 'مطور برمجيات حاصل على شهادة الماستر، متخصص في بناء الأنظمة المتكاملة وتطبيقات الجوال الحديثة. أمتلك خبرة في Laravel و Flutter لبناء حلول رقمية مبتكرة.'
                            : 'Master’s degree holder and software developer expert in building integrated systems and modern mobile apps using Laravel and Flutter.' }}
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-black uppercase mb-6 border-b-2 border-blue-100 pb-2 inline-block">
                        {{ $isAr ? 'المشاريع الرئيسية' : 'Key Projects' }}</h2>
                    <div class="space-y-8">
                        <div>
                            <h4 class="font-black text-slate-900 uppercase">AuraBook - SaaS Booking System</h4>
                            <p class="text-blue-600 text-xs font-bold mb-2">Laravel / MySQL / Tailwind</p>
                            <p class="text-slate-500 text-xs leading-relaxed">
                                {{ $isAr ? 'نظام متكامل لإدارة الحجوزات يدعم تعدد المستأجرين (Multi-tenancy).' : 'Integrated booking management system supporting multi-tenancy.' }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 uppercase">Multilingual Portfolio</h4>
                            <p class="text-blue-600 text-xs font-bold mb-2">Laravel 12 / Livewire</p>
                            <p class="text-slate-500 text-xs leading-relaxed">
                                {{ $isAr ? 'موقع شخصي يدعم ثلاث لغات مع تصميم عصري متجاوب.' : 'Personal portfolio supporting 3 languages with modern responsive design.' }}
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-black uppercase mb-4 border-b-2 border-blue-100 pb-2 inline-block">
                        {{ $isAr ? 'التعليم' : 'Education' }}</h2>
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-black text-slate-900">
                                {{ $isAr ? 'ماستر في علوم الحاسوب' : 'Master’s Degree in Computer Science' }}</h4>
                            <p class="text-slate-500 text-xs mt-1">
                                {{ $isAr ? 'تخصص برمجة وتطوير الأنظمة' : 'Software Development Specialization' }}</p>
                        </div>
                        <span class="text-[10px] font-black bg-slate-100 px-2 py-1 rounded">2021 - 2023</span>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
