<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart E-Learning | 404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { background-color: #f7f9fa; font-family: 'Inter', sans-serif; }
        .error-wrapper { height: 100vh; display: flex; align-items: center; justify-content: center; }
        .error-404 { font-size: 10rem; font-weight: 900; background: linear-gradient(135deg, #0d6efd, #0045a1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .btn-primary { background-color: #0d6efd; border: none; padding: 12px 30px; }
        .badge-link { transition: 0.3s; cursor: pointer; text-decoration: none; }
        .badge-link:hover { background-color: #0d6efd !important; color: #fff !important; }
    </style>
</head>
<body>

    @include('layouts.header');

<div class="error-wrapper">
    <div class="container text-center px-4">
        <h1 class="error-404">404</h1>
        <h2 class="fw-bold text-dark mb-3">Oops! We can't find that page.</h2>
        <p class="text-muted mb-5 mx-auto" style="max-width: 550px;">
            The link you followed might be broken, or the page has been moved. 
            Try searching for a course or returning to the homepage.
        </p>

        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mb-5">
            <a href="{{ url('/') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm">
                <i class="bi bi-house-door me-2"></i>Back to Homepage
            </a>
            <button onclick="window.history.back()" class="btn btn-outline-dark rounded-pill fw-bold">
                <i class="bi bi-arrow-left me-2"></i>Go Back
            </button>
        </div>

        <div class="pt-4 border-top">
            <p class="small text-uppercase fw-bold text-secondary mb-3">Popular Categories</p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="/categories/development" class="badge bg-white text-dark border p-2 px-3 rounded-pill badge-link">Development</a>
                <a href="/categories/business" class="badge bg-white text-dark border p-2 px-3 rounded-pill badge-link">Business</a>
                <a href="/categories/it-software" class="badge bg-white text-dark border p-2 px-3 rounded-pill badge-link">IT & Software</a>
            </div>
        </div>
    </div>
</div>

  @include('layouts.footer');

</body>
</html>