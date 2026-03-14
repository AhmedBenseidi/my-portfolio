<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools; // 1. تأكد من استدعاء الحزمة هنا

class PortfolioController extends Controller
{
    public function index()
    {
        // --- إعدادات الـ SEO ---
// الحصول على اللغة الحالية للموقع (ar, en, fr)
    $locale = app()->getLocale();

    if ($locale == 'ar') {
        SEOTools::setTitle('أحمد | مطور Full-Stack - Laravel & Flutter');
        SEOTools::setDescription('مطور برمجيات متخصص في Laravel و Flutter، خبير في بناء أنظمة SaaS وحلول الويب المتكاملة.');
    } elseif ($locale == 'fr') {
        SEOTools::setTitle('Ahmed | Développeur Full-Stack - Laravel & Flutter');
        SEOTools::setDescription('Développeur logiciel spécialisé en Laravel et Flutter, expert في بناء أنظمة SaaS et solutions web intégrées.');
    } else {
        // الإنجليزية كخيار افتراضي
        SEOTools::setTitle('Ahmed | Full-Stack Developer - Laravel & Flutter');
        SEOTools::setDescription('Software Developer specialized in Laravel & Flutter, expert in building SaaS systems and integrated web solutions.');
    }
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::addImages(['images/og-portfolio.png']);
        SEOTools::setCanonical(url('/'));
        // -----------------------

        // جلب المهارات مرتبة حسب الأهمية أو الأحدث
        $skills = Skill::all()->groupBy('category');

        // جلب آخر 6 مشاريع مع ترتيبها من الأحدث للأقدم
        $projects = Project::latest()->get();

        // تمرير البيانات للواجهة
        return view('welcome', compact('skills', 'projects'));
    }
}
