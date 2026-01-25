<div class="container-fluid login-container d-flex align-items-stretch p-0">
    <div class="row flex-fill w-100 m-0">

        <x-slot name="breadcrumbSlot">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-decoration-none">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </x-slot>

        <div class="col-md-6 login-left d-flex justify-content-center align-items-center">
            
            <div>
                <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" class="login-logo mb-3">
                <h2 class="text-blue fw-bold">Admin Login</h2>
                <p class="text-blue">Learn, Grow, and Succeed</p>
            </div>
        </div>

        <div class="col-md-6 login-right bg-white shadow-sm">
            <div class="w-100 d-flex justify-content-center align-items-center">
                <div class="card login-card shadow-sm border rounded-3 bg-white">
                    <div class="card-body">

                        <h3 class="mb-4 text-center">Sign In</h3>
                        <form wire:submit.prevent="login">

                            @if (session()->has('error'))
                                <div class="alert alert-danger border-0 small py-2 mb-4">{{ session('error') }}</div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control" id="email" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" wire:model="password" class="form-control" id="password" required>
                                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div> <hr> --}}

                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="login">
                                <span wire:loading wire:target="login" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Continue
                            </button>

                        </form> 

                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

