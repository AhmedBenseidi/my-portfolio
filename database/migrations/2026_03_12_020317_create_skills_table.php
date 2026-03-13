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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // مثال: Laravel
            $table->string('category'); // مثال: Backend
            $table->string('icon'); // مثال: fab fa-laravel

            // إضافة حقل الإتقان (الذي تسبب في الخطأ سابقاً)
            // نستخدم integer وقيمة افتراضية 100
            $table->integer('proficiency')->default(100);

            // جعل اللون مرناً (مثال: #3b82f6 أو blue-600)
            $table->string('color')->default('blue-600');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
