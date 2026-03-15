<h2>New Course Alert!</h2>

<p>Hello,</p>

<p>A new course has just been uploaded by <strong>{{ $course->instructor->name }}</strong>:</p>

<p><strong>{{ $course->title }}</strong></p>

<p>{{ $course->short_description }}</p>

<p>
    <a href="{{ route('course-details', $course->slug) }}">View Course</a>
</p>

<p>Happy Learning!</p>