<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Smart E-Learning | {{ $title ?? 'Online Courses Platform' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Smart E-Learning platform offering professional online courses in web development, programming, business and technology.' }}">
    <meta name="keywords" content="online courses, e-learning, web development, programming, smartlms">
    <meta name="author" content="Smart E-Learning">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Smart E-Learning' }}">
    <meta property="og:image" content="{{ asset('images/Smartlms_logos.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <link rel="icon" href="{{ asset('images/Smartlms_logos.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @include('layouts.header')

    <main class="container py-4">
        @if (isset($breadcrumbSlot))
            <div class="mb-3">
                {{ $breadcrumbSlot }}
            </div>
        @endif

        {{ $slot ?? '' }}
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts

</body>
</html>
