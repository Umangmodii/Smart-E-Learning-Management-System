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
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_section_id')
                ->constrained('course_sections')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('video_path')->nullable();

            $table->unsignedInteger('duration')->default(0); // store in seconds

            $table->boolean('is_preview')->default(false);
            $table->unsignedInteger('order')->default(0);

            $table->index(['course_section_id', 'order']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lectures');
    }
};
