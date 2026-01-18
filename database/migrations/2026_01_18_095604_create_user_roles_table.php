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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

            // Foreign key to roles table
            $table->foreignId(column: 'role_id')
            ->constrained('roles')
            ->cascadeOnDelete();

            $table->unique(['user_id', 'role_id']); // Both user and role combination should be unique

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
