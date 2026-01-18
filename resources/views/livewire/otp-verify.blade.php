<div class="container-fluid login-container d-flex align-items-stretch p-0">
    <div class="row flex-fill w-100 m-0">
        <div class="col-md-6 login-left d-flex justify-content-center align-items-center">
            <div>
                <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" class="login-logo mb-3">
                <h2 class="text-blue fw-bold"> Verify OTP </h2>
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

                        <h4 class="mb-1">Check your inbox</h4>
                        <p class="text-muted small mb-3">Enter the 6-digit code we sent to <strong>{{ session('otp_user_email') }}</strong> to finish your login.</p>

                        <form wire:submit.prevent="otp_verification">
                            <input type="text" wire:model="otp"
                                class="form-control text-center mb-3"
                                placeholder="Enter 6-digit OTP" maxlength="6">

                            <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="otp_verification">
                                <span wire:loading wire:target="otp_verification" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Verify OTP
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
