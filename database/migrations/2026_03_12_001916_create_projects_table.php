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
            $table->string('title');            // عنوان المشروع
            $table->text('description');      // وصف المشروع
            $table->string('thumbnail');       // صورة للمشروع
            $table->string('link')->nullable(); // رابط المشروع أو GitHub
            $table->json('tags');              // التقنيات المستخدمة (Array)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
