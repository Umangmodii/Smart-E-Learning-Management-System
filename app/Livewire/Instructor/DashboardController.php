<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseReview;
use App\Models\Payments;
use App\Models\EnrollCourses;

class DashboardController extends Component
{
    public $breadcrumbs = [];
    public $totalviews = 0;

    public function mount()
    {
        $instructorId = auth()->id();
        
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];

        $this->totalviews = \DB::table('sessions')
        ->where('last_activity', '>=', now()->subMinutes(15)->getTimestamp())
        ->count();
    }

    public function render()
    {
        $instructorId = Auth::id();

        // Courses activity
        $courses = Course::where('user_id', $instructorId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($course) {
                return [
                    'type' => 'course',
                    'title' => 'New Course Created',
                    'message' => $course->title,
                    'user' => $course->instructor,
                    'time' => $course->created_at,
                ];
            });


        // Reviews activity
        $reviews = CourseReview::whereHas('course', function ($q) use ($instructorId) {
                $q->where('user_id', $instructorId);
            })
            ->with('user', 'course')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($review) {
                return [
                    'type' => 'review',
                    'title' => 'New Review (' . $review->rating . '⭐)',
                    'message' => $review->course->title,
                    'user' => $review->user,
                    'time' => $review->created_at,
                ];
            });

        $payments = Payments::whereHas('order.course', function ($q) use ($instructorId) {
                $q->where('user_id', $instructorId);
            })
            ->with('order')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($payment) {
                return [
                    'type' => 'payment',
                    'title' => 'Payment Received',
                    'message' => '₹' . $payment->amount,
                    'user' => null,
                    'time' => $payment->created_at,
                ];
            });

        $recentActivity = $courses
            ->merge($reviews)
            ->merge($payments)
            ->sortByDesc('time')
            ->take(5);

        $days = request()->get('days', 7);

        $enrollmentData = EnrollCourses::whereHas('course', function($q) use ($instructorId) {
                $q->where('user_id', $instructorId);
            })
            ->where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $enrollmentData->pluck('date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->format('D'))
            ->toArray();

        $chartValues = $enrollmentData->pluck('count')->toArray();

    return view('livewire.instructor.dashboard', [
        'totalCourses'   => Course::where('user_id', $instructorId)->count(),
        'activeCourses'  => Course::where('user_id', $instructorId)->where('status', 2)->count(),
        'totalStudents' => EnrollCourses::whereHas('course', fn($q) => $q->where('user_id', $instructorId))->count(),
        'pendingCourses' => Course::where('user_id', $instructorId)->where('status', 1)->count(),
        'latestCourses'  => Course::where('user_id', $instructorId)->latest()->take(5)->get(),
        'totalReviews'   => CourseReview::whereHas('course', fn($q) => $q->where('user_id', $instructorId))->count(),
        'totalRatings'   => CourseReview::whereHas('course', fn($q) => $q->where('user_id', $instructorId))->sum('rating'),
        'totalRevenue'   => Payments::whereHas('order.course', fn($q) => $q->where('user_id', $instructorId))
                            ->where('status', 'success')
                            ->sum('amount'),
        'recentActivity' => $recentActivity,
        'chartLabels' => $chartLabels,
        'chartValues' => $chartValues,
    ])->layout('layouts.instructor.dashboard',['title' => 'Instructor Dashboard']);
  }
}
