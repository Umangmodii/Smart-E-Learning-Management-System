@extends('layouts.instructor.main')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="text-center p-5 shadow-sm rounded-4 bg-white border" style="max-width: 600px;">
        <div class="mb-4">
            <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        
        <h2 class="fw-bold text-dark">Review in Progress</h2>
        <p class="text-muted mb-4">
            Hello, <strong>{{ auth()->user()->name }}</strong>! Thank you for applying to teach on SmartLMS. 
            Our administration team is currently verifying your profile and credentials.
        </p>

        <div class="alert alert-light border d-flex align-items-center text-start mb-4">
            <i class="bi bi-info-circle-fill text-primary fs-4 me-3"></i>
            <small class="text-secondary">
                This process usually takes <strong>24 to 48 hours</strong>. You will receive an email confirmation once your dashboard is unlocked.
            </small>
        </div>

        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 rounded-pill">Back to Home</a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-danger">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection