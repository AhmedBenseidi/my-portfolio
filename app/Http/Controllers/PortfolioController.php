<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class PortfolioController extends Controller
{
    public function index()
    {
        // --- إعدادات الـ SEO حسب اللغة ---
        $locale = app()->getLocale();

        if ($locale === 'ar') {
            SEOTools::setTitle('أحمد بن اسعيدي | مطور Full-Stack - Laravel & Flutter');
            SEOTools::setDescription('مطور برمجيات متخصص في Laravel و Flutter، خبير في بناء أنظمة SaaS وحلول الويب المتكاملة.');
        } elseif ($locale === 'fr') {
            SEOTools::setTitle('Ahmed Benseidi| Développeur Full-Stack - Laravel & Flutter');
            SEOTools::setDescription('Développeur logiciel spécialisé en Laravel et Flutter, expert في بناء أنظمة SaaS et solutions web intégrées.');
        } else {
            SEOTools::setTitle('Ahmed Bensaidi| Full-Stack Developer - Laravel & Flutter');
            SEOTools::setDescription('Software Developer specialized in Laravel & Flutter, expert in building SaaS systems and integrated web solutions.');
        }

        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::addImages(['images/og-portfolio.png']);
        SEOTools::setCanonical(url('/'));

        // جلب المهارات
        $skills = Skill::all()->groupBy('category');

        // جلب المشاريع وتحويل آمن لحقل tags إلى مصفوفة
        $projects = Project::latest()->get()->map(function ($p) {
            // إذا كان tags نصياً: حاول فك JSON أولاً، وإلا اعتبره نص مفصول بفواصل
            if (is_string($p->tags)) {
                $decoded = json_decode($p->tags, true);
                if (is_array($decoded)) {
                    $p->tags = array_values($decoded);
                } else {
                    $p->tags = array_values(array_filter(array_map('trim', explode(',', $p->tags))));
                }
            } else {
                $p->tags = $p->tags ?? [];
            }

            // ضمان نوع موحد (array) حتى لو كان null أو collection
            if ($p->tags instanceof \Illuminate\Support\Collection) {
                $p->tags = $p->tags->values()->all();
            }

            return $p;
        });

        return view('welcome', compact('skills', 'projects'));
    }
}
