<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {

            $table->string('short_description', 255)
                  ->nullable()
                  ->after('title');

            $table->longText('description')
                  ->nullable()
                  ->after('short_description');

            $table->decimal('price', 10, 2)
                  ->default(0.00)
                  ->after('description');

            $table->decimal('discount_price', 10, 2)
                  ->nullable()
                  ->after('price');

            $table->enum('level', [
                    'beginner',
                    'intermediate',
                    'advanced',
                    'all_levels'
                ])
                ->default('beginner')
                ->after('discount_price');

            $table->string('language', 50)
                  ->default('English')
                  ->after('level');

            $table->text('meta_keywords')
                  ->nullable()
                  ->after('language');

            $table->string('video_promo_path', 255)
                  ->nullable()
                  ->after('meta_keywords');

            $table->integer('total_duration')
                  ->default(0)
                  ->comment('Total seconds')
                  ->after('video_promo_path');

            $table->boolean('is_published')
                  ->default(false)
                  ->after('total_duration');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'description',
                'price',
                'discount_price',
                'level',
                'language',
                'meta_keywords',
                'video_promo_path',
                'total_duration',
                'is_published',
            ]);
        });
    }
};
