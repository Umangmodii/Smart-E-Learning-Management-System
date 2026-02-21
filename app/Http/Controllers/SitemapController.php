<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Course;
class SitemapController extends Controller
{
    public function index()
    {
         $sitemap = Sitemap::create();

        // Home Page
        $sitemap->add(
            Url::create(url('/'))
                ->setPriority(1.0)
        );

        $sitemap->add(
    Url::create(url('/about'))->setPriority(0.6)
        );

        $sitemap->add(
            Url::create(url('/contact'))->setPriority(0.6)
        );

        // Courses Page
        $sitemap->add(
            Url::create(url('/courses'))
                ->setPriority(0.8)
        );

        // Only Published Courses
        $courses = Course::where('status', 2)
                        ->get();

        foreach ($courses as $course) {
            $sitemap->add(
                Url::create(url("/course/{$course->slug}"))
                    ->setLastModificationDate($course->updated_at)
                    ->setPriority(0.9)
            );
        }

        return $sitemap->toResponse(request());
    }
}
