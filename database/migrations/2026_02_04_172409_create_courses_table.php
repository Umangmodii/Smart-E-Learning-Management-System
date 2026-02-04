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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); 
            // The Instructor (from 'users' table)
            $table->foreignId('user_id')->constrained( 'users')->onDelete('cascade');
            // The Admin (from your custom 'admin' table)
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('admin')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            // Status: 0=Draft, 1=Pending, 2=Published, 3=Rejected
            $table->tinyInteger('status')->default(0)->index(); 
            // Real-Time Metadata
            $table->timestamp('submitted_at')->nullable(); // When Instructor clicked "Submit"
            $table->timestamp('approved_at')->nullable();  // When Admin clicked "Approve"
            $table->text('admin_feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
