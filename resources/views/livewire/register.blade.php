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
                <img src="{{ asset('images/smartlms_logo.png') }}" class="login-logo mb-3">
                <h2 class="text-blue fw-bold">Join Smart E-Learning</h2>
                <p class="text-blue">Create your account and start learning</p>
            </div>
        </div>

        <div class="col-md-6 login-right bg-white shadow-sm">
            <div class="w-100 d-flex justify-content-center align-items-center">
                <div class="card login-card shadow-sm bg-white">
                    <div class="card-body">

                        @if (session()->has('success'))
                           <div class="alert alert-success">
                               {{ session('success') }}
                           </div>
                        @elseif (session()->has('error'))
                           <div class="alert alert-danger">
                               {{ session('error') }}
                           </div>
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

                        <h3 class="mb-4 text-center">Create New Account</h3>

                        <form wire:submit.prevent="register">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" wire:model="name" class="form-control" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" wire:model="password" class="form-control" required>
                                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" wire:model="password_confirmation" class="form-control" required>
                                @error('password_confirmation') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="register">
                                <span wire:loading wire:target="register" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Continue
                            </button>
                        </form>

                         <hr>

                            <p class="text-center text-muted mb-3">Or continue with</p>

                            <div class="row g-3 mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <a href="{{ url('/auth/github')}}" class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2 social-btn" aria-label="Sign in with GitHub">
                                        <!-- GitHub SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M12 .5C5.73.5.5 5.73.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.53-1.35-1.3-1.71-1.3-1.71-1.06-.72.08-.71.08-.71 1.17.08 1.79 1.2 1.79 1.2 1.04 1.78 2.72 1.27 3.39.97.11-.75.41-1.27.75-1.56-2.55-.29-5.24-1.28-5.24-5.69 0-1.26.45-2.3 1.19-3.11-.12-.29-.52-1.47.11-3.06 0 0 .97-.31 3.18 1.19a11.06 11.06 0 0 1 2.9-.39c.98.01 1.97.13 2.9.39 2.2-1.5 3.17-1.19 3.17-1.19.63 1.59.23 2.77.11 3.06.74.81 1.19 1.85 1.19 3.11 0 4.42-2.7 5.4-5.27 5.68.42.36.8 1.08.8 2.18 0 1.58-.01 2.85-.01 3.24 0 .31.21.68.8.56A11.53 11.53 0 0 0 23.5 12C23.5 5.73 18.27.5 12 .5z"/>
                                        </svg>
                                        <span>GitHub</span>
                                    </a>
                                </div>

                                <div class="col-12 col-md-4">
                                    <a href="{{ url('/auth/google')}}" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2 social-btn" aria-label="Sign in with Google">
                                        <!-- Google SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
                                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.06 1.53 7.45 2.8l5.45-5.28C34.81 4.05 29.78 2 24 2 14.73 2 6.95 7.2 3.01 15.04l6.6 5.11C10.8 15.1 16.84 9.5 24 9.5z"/>
                                            <path fill="#34A853" d="M46.5 24c0-1.64-.14-2.84-.42-4.08H24v7.72h12.97c-.56 3.06-3.45 8.5-12.97 8.5-7.16 0-13.2-5.6-14.39-12.55l-6.6 5.11C6.95 40.8 14.73 46 24 46c12.22 0 21.5-9.34 21.5-22z"/>
                                            <path fill="#FBBC05" d="M9.61 29.86A14.99 14.99 0 0 1 8 24c0-1.64.36-3.22 1.01-4.68L3.01 14.21A24 24 0 0 0 0 24c0 3.92.93 7.63 3.01 10.79l6.6-5.11z"/>
                                            <path fill="#4285F4" d="M24 44c5.78 0 10.81-2.05 14.45-5.33l-6.64-5.11C30.06 34.47 27.54 36 24 36c-9.16 0-15.2-5.6-16.98-12.55l-6.6 5.11C6.95 40.8 14.73 46 24 46z"/>
                                        </svg>
                                        <span>Google</span>
                                    </a>
                                </div>

                                <div class="col-12 col-md-4">
                                    <a href="{{ url('/auth/facebook')}}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 social-btn" aria-label="Sign in with Facebook">
                                        <!-- Facebook SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M22 12a10 10 0 1 0-11.5 9.87v-6.99H8.9V12h1.6V9.8c0-1.57.93-2.44 2.36-2.44.69 0 1.42.12 1.42.12v1.57h-.81c-.8 0-1.05.5-1.05 1.02V12h1.78l-.28 2.88h-1.5v6.99A10 10 0 0 0 22 12z"/>
                                        </svg>
                                        <span>Facebook</span>
                                    </a>
                                </div>
                            </div>

                        <div class="text-center mt-3 md-2 color-gray">
                            Already have an account?
                            <a href="{{ route('login') }}">Sign In</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
