<div class="container-fluid login-container d-flex align-items-stretch p-0">
    <div class="row flex-fill w-100 m-0">
        <div class="col-md-6 login-left d-flex justify-content-center align-items-center">
            <div>
                <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" class="login-logo mb-3">
                <h2 class="text-blue fw-bold">Welcome to Smart E-Learning</h2>
                <p class="text-blue">Learn, Grow, and Succeed</p>
            </div>
        </div>

        <div class="col-md-6 login-right bg-white shadow-sm">
            <div class="w-100 d-flex justify-content-center align-items-center">
                <div class="card login-card shadow-sm border rounded-3 bg-white">
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h3 class="mb-4 text-center">Sign In</h3>
                        <form wire:submit.prevent="login">
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
                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="login">
                                <span wire:loading wire:target="login" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Login
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            Don't have an account? <a href="{{ route(name: 'register') }}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
