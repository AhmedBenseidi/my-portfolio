<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // عنوان المشروع
            $table->string('title');

            // وصف المشروع
            $table->string('thumbnail')->nullable()->after('description');

            // رابط الصورة من Cloudinary (نصي)
            $table->string('thumbnail');

            // رابط خارجي (GitHub أو موقع المشروع)
            $table->string('link')->nullable();

            // التقنيات المستخدمة (نخزنها كـ JSON Array)
            $table->json('tags');

            // تاريخ الإنشاء والتعديل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
};
