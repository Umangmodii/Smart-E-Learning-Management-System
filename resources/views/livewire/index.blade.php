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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

@include('layouts.header')

<div class="banner-management-wrapper">
    @if(str_contains(request()->url(), 'admin'))
        <div class="container-fluid py-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3 text-primary">
                            <i class="bi bi-collection-play fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">Banner Management</h4>
                            <p class="text-muted small mb-0">Hierarchy & Content Control Panel</p>
                        </div>
                    </div>
                    <ul class="nav nav-tabs border-0 gap-2 mt-2">
                        <li class="nav-item">
                            <button class="nav-link border-0 rounded-3 px-4 py-2 fw-semibold {{ $activeTab == 'manage' ? 'active bg-light text-primary' : 'text-muted' }}" wire:click="switchTab('manage')">List</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link border-0 rounded-3 px-4 py-2 fw-semibold {{ $activeTab == 'form' ? 'active bg-light text-primary' : 'text-muted' }}" wire:click="switchTab('form')">Add/Edit</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if($banners->count() > 0)
    <section id="hero-slider" class="carousel slide carousel-fade shadow-lg" data-bs-ride="carousel">
        <div class="carousel-indicators custom-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#hero-slider" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"></button>
            @endforeach
        </div>

        {{-- Slides --}}
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="6000">
                    <div class="banner-container">
                        <div class="banner-bg" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.7) 100%), url('{{ asset('Storage/' . $banner->image) }}');">
                            
                            <div class="container h-100">
                                <div class="row h-100 align-items-center justify-content-center justify-content-md-start">
                                    <div class="col-xl-6 col-lg-7 col-md-9 text-white text-center text-md-start">
                                        <div class="px-2 animate__animated animate__fadeIn">
                                            @if($banner->title)
                                                <h1 class="responsive-h1 fw-bold mb-2 text-uppercase">
                                                    {{ $banner->title }}
                                                </h1>
                                            @endif
                                            
                                            @if($banner->subtitle)
                                                <p class="responsive-p mb-4 opacity-90">
                                                    {{ $banner->subtitle }}
                                                </p>
                                            @endif

                                            @if($banner->button_text && $banner->button_url)
                                                <a href="{{ $banner->button_url }}" class="btn btn-primary btn-custom rounded-pill shadow-lg">
                                                    {{ $banner->button_text }} <i class="bi bi-arrow-right-short ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
            <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#hero-slider" data-bs-slide="prev">
                <span class="bi bi-chevron-left fs-1"></span>
            </button>
            <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#hero-slider" data-bs-slide="next">
                <span class="bi bi-chevron-right fs-1"></span>
            </button>
        @endif
    </section>
    @endif

</div>

@include('layouts.footer')

</body>
</html>