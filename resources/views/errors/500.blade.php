<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart E-Learning | 500 Internal Server Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { background-color: #fff; color: #2d2f31; font-family: 'Inter', sans-serif; overflow: hidden; }
        .error-wrapper { height: 100vh; display: flex; align-items: center; justify-content: center; }
        .error-icon { font-size: 5rem; color: #dc3545; margin-bottom: 1.5rem; }
        .error-title { font-size: 2.5rem; font-weight: 800; color: #1c1d1f; }
        .btn-refresh { background-color: #1c1d1f; color: #fff; border: none; padding: 12px 30px; transition: 0.3s; }
        .btn-refresh:hover { background-color: #000; color: #fff; }
        
        /* Subtle animation for the gear icon */
        .spin-slow { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

<div class="error-wrapper">
    <div class="container text-center px-4">
        <div class="error-icon">
            <i class="bi bi-gear-fill spin-slow"></i>
        </div>

        <h1 class="error-title">Internal Server Error</h1>
        <p class="text-muted mb-5 mx-auto" style="max-width: 550px;">
            Something went wrong on our end. We're currently working on fixing it. 
            Please try refreshing the page or come back in a few minutes.
        </p>

        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <button onclick="window.location.reload()" class="btn btn-refresh rounded-0 fw-bold shadow-sm">
                <i class="bi bi-arrow-clockwise me-2"></i>Refresh Page
            </button>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-0 fw-bold">
                Go to Homepage
            </a>
        </div>

        <div class="mt-5 pt-4">
            <img src="{{ asset('images/smartlms_logo.png') }}" alt="SmartLMS Logo" height="35" class="opacity-50">
            <p class="extra-small text-muted mt-2">Error Code: 500 (Internal Server Error)</p>
        </div>
    </div>
</div>

</body>
</html>