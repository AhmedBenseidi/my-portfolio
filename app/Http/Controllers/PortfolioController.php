<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // جلب المهارات مرتبة حسب الأهمية أو الأحدث
        $skills = Skill::all()->groupBy('category');
        // جلب آخر 6 مشاريع مع ترتيبها من الأحدث للأقدم
        $projects = Project::latest()->get();

        // تمرير البيانات للواجهة
        return view('welcome', compact('skills', 'projects'));
    }
}
