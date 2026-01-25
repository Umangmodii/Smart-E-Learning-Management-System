<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Smart E-Learning | {{ $title ?? 'E-Learning' }} </title>
        <!-- Favicons -->
        <link rel="icon" href="{{ asset('images/smartlms_logo.png') }}" type="image/svg+xml">
        <link rel="icon" href="{{ asset('images/smartlms_logo.png') }}" sizes="32x32">
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

</head>
<body>
    {{-- Header Layout --}}
    @include('layouts.admin.header')

    {{-- Content Layout --}}
    <div class="container py-4">
        <div class="main-container">
            @if (isset($breadcrumbSlot))
                <div class="container mt-3">
                    {{ $breadcrumbSlot }}
                </div>
            @endif
        </div>

        {{ $slot ?? '' }}
    </div>

    {{-- Footer Layout --}}
    @include('layouts.admin.footer')

    @livewireScripts
</body>
</html>