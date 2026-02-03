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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();$table->string('name');
            $table->string('slug')->unique(); // For SEO: /courses/web-development
            
            // Parent-Child Relationship (Self-referencing)
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
            
            $table->foreignId('created_by')
                  ->constrained('admin')
                  ->onDelete('cascade');
            
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->integer('order_priority')->default(0); // For menu sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
