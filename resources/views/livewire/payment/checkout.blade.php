<div class="container-fluid login-container d-flex align-items-stretch p-0">
    <div class="row flex-fill w-100 m-0">

        <x-slot name="breadcrumbSlot">
            <nav aria-label="breadcrumb" class="py-2 bg-light border-bottom mb-4">
                <div class="container">
                    <ol class="breadcrumb mb-0 small">
                        @foreach($breadcrumbs ?? [] as $item)
                            <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                                @if(!empty($item['url']) && !$loop->last)
                                    <a href="{{ $item['url'] }}" class="text-decoration-none text-primary">{{ $item['label'] }}</a>
                                @else
                                    {{ $item['label'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            </nav>
        </x-slot>

       <div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm p-4 rounded-0 border bg-white h-100">
                <h4 class="fw-bold mb-4">Billing address</h4>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Country</label>
                        <select wire:model.live="country_id" class="form-select border-secondary-subtle rounded-0 p-3 shadow-none">
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">State / Union Territory</label>
                        <select wire:model.live="state_id" class="form-select border-secondary-subtle rounded-0 p-3 shadow-none" {{ empty($states) ? 'disabled' : '' }}>
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">City</label>
                        <select wire:model.live="city_id" class="form-select border-secondary-subtle rounded-0 p-3 shadow-none" {{ empty($cities) ? 'disabled' : '' }}>
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-auto pt-4">
                    <p class="text-muted mb-0" style="font-size: 0.75rem;">
                        SmartLMS is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm p-4 sticky-top rounded-0 border bg-white" style="top: 20px;">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <hr>
                <h6 class="text-muted fw-bold small mb-1">Order Total:</h6>
                <h1 class="fw-bold mb-4 text-primary">₹{{ number_format($totalPrice ?? 0, 2) }}</h1>
                
                <button wire:click="processPayment" wire:loading.attr="disabled" class="btn btn-primary btn-lg w-100 fw-bold py-3 mb-3 rounded-0 border-0">
                    <span wire:loading.remove>Proceed <i class="bi bi-lock-fill ms-2"></i></span>
                    <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span>Processing...</span>
                </button>
                
                <p class="text-muted small text-center mb-4" style="font-size: 0.7rem;">
                    By completing your purchase, you agree to these <a href="#" class="text-dark text-decoration-underline">Terms of Use</a>.
                </p>
                
                <div class="bg-light p-3 text-center border">
                    <p class="fw-bold small mb-1 text-dark"><i class="bi bi-patch-check text-success me-1"></i> 30-Day Money-Back Guarantee</p>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Not satisfied? Get a full refund within 30 days.</p>
                </div>
            </div>
        </div>
    </div>
</div>
    </div> 
</div> 

  {{-- <div class="card border-0 shadow-sm p-4 rounded-0 border">
    
    <h5 class="fw-bold mb-3">Payment method</h5>
    <p class="text-muted small mb-4">
        Secure and encrypted <i class="bi bi-lock-fill"></i>
    </p>

  <div class="border p-0 mb-4 rounded-0 border-dark">
    <div class="p-3 border-bottom bg-light d-flex align-items-center">
        <div class="d-flex align-items-center">
            <input type="radio" id="upiMethod" name="payment_method" value="upi" 
                class="form-check-input me-3 shadow-none" checked style="width: 20px; height: 20px;">
            <label for="upiMethod" class="mb-0 fw-bold h6 text-uppercase">UPI</label>
        </div>
    </div>

        <div class="p-4 bg-white">
            <p class="text-muted small mb-4">Select your preferred UPI app to pay:</p>

            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between border p-3 rounded-0 cursor-pointer hover-shadow" style="border-color: #dee2e6 !important;">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center border rounded me-3" style="width: 50px; height: 35px; background-color: #f8f9fa;">
                                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><circle cx="-25.926" cy="41.954" r="29.873" fill="#5f259f" transform="rotate(-76.714 -48.435 5.641) scale(8.56802)"/><path d="M372.164 189.203c0-10.008-8.576-18.593-18.584-18.593h-34.323l-78.638-90.084c-7.154-8.577-18.592-11.439-30.03-8.577l-27.17 8.577c-4.292 1.43-5.723 7.154-2.862 10.007l85.8 81.508H136.236c-4.293 0-7.154 2.861-7.154 7.154v14.292c0 10.016 8.585 18.592 18.592 18.592h20.015v68.639c0 51.476 27.17 81.499 72.931 81.499 14.292 0 25.739-1.431 40.03-7.146v45.753c0 12.87 10.016 22.886 22.885 22.886h20.015c4.293 0 8.577-4.293 8.577-8.586V210.648h32.893c4.292 0 7.145-2.861 7.145-7.145v-14.3zM280.65 312.17c-8.576 4.292-20.015 5.723-28.591 5.723-22.886 0-34.324-11.438-34.324-37.176v-68.639h62.915v100.092z" fill="#fff" fill-rule="nonzero"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold small">PhonePe</p>
                                <span class="text-muted" style="font-size: 0.7rem;">Pay via PhonePe App</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between border p-3 rounded-0 cursor-pointer hover-shadow" style="border-color: #dee2e6 !important;">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center border rounded me-3" style="width: 50px; height: 35px; background-color: #f8f9fa;">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                                    <path fill="#e64a19" d="M42.858,11.975c-4.546-2.624-10.359-1.065-12.985,3.481L23.25,26.927	c-1.916,3.312,0.551,4.47,3.301,6.119l6.372,3.678c2.158,1.245,4.914,0.506,6.158-1.649l6.807-11.789	C48.176,19.325,46.819,14.262,42.858,11.975z"></path><path fill="#fbc02d" d="M35.365,16.723l-6.372-3.678c-3.517-1.953-5.509-2.082-6.954,0.214l-9.398,16.275	c-2.624,4.543-1.062,10.353,3.481,12.971c3.961,2.287,9.024,0.93,11.311-3.031l9.578-16.59	C38.261,20.727,37.523,17.968,35.365,16.723z"></path><path fill="#43a047" d="M36.591,8.356l-4.476-2.585c-4.95-2.857-11.28-1.163-14.137,3.787L9.457,24.317	c-1.259,2.177-0.511,4.964,1.666,6.22l5.012,2.894c2.475,1.43,5.639,0.582,7.069-1.894l9.735-16.86	c2.017-3.492,6.481-4.689,9.974-2.672L36.591,8.356z"></path><path fill="#1e88e5" d="M19.189,13.781l-4.838-2.787c-2.158-1.242-4.914-0.506-6.158,1.646l-5.804,10.03	c-2.857,4.936-1.163,11.252,3.787,14.101l3.683,2.121l4.467,2.573l1.939,1.115c-3.442-2.304-4.535-6.92-2.43-10.555l1.503-2.596	l5.504-9.51C22.083,17.774,21.344,15.023,19.189,13.781z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold small">Google Pay</p>
                                <span class="text-muted" style="font-size: 0.7rem;">Pay via GPay App</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between border p-3 rounded-0 cursor-pointer hover-shadow" style="border-color: #dee2e6 !important;">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center justify-content-center border rounded me-3" style="width: 50px; height: 35px; background-color: #f8f9fa;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Paytm_Logo_%28standalone%29.svg/1200px-Paytm_Logo_%28standalone%29.svg.png" alt="Paytm" style="height: 12px;">
                            </div>
                            <div>
                                <p class="mb-0 fw-bold small">Paytm</p>
                                <span class="text-muted" style="font-size: 0.7rem;">Pay via Paytm Wallet/UPI</span>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="mt-4 pt-3 border-top">
                <label class="small fw-bold mb-2">Or enter UPI ID</label>
                <div class="input-group">
                    <input type="text" class="form-control rounded-0 border-dark shadow-none" placeholder="example@bank">
                    <button class="btn btn-outline-dark rounded-0 fw-bold px-3">Verify</button>
                </div>
            </div> --}}
        {{-- </div>
    </div> --}}

        {{-- <div class="border p-3 rounded-0">
            
            <div class="d-flex align-items-center mb-3">
                <input type="radio" name="payment_method" class="form-check-input me-2">
                <h6 class="mb-0 fw-bold">Credit / Debit / ATM Card</h6>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Card Number</label>
                <input type="text" class="form-control p-3 rounded-0 border-dark" placeholder="1234 5678 9012 3456">
            </div>

            <div class="row g-3">
                
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Valid Through</label>
                    <input type="text" class="form-control p-3 rounded-0 border-dark" placeholder="MM/YY">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold">CVV</label>
                    <input type="password" class="form-control p-3 rounded-0 border-dark" placeholder="123" maxlength="3">
                </div>

            </div>

        </div>

    </div>
</div> --}}


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('startRazorpay', (event) => {
        const data = Array.isArray(event) ? event[0] : event;
        
        console.log("Opening Razorpay with:", data); 

        var options = {
            "key": data.key, 
            "amount": data.amount, 
            "currency": "INR",
            "name": "Smart E-Learning",
            "description": data.name,
            "order_id": data.order_id,
            // --- ADDED PREFILL ---
            "prefill": {
                "name": "{{ auth()->user()->name }}",
                "email": "{{ auth()->user()->email }}",
                "contact": "" 
            },
            "handler": function (response) {
                fetch('/payment/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature
                    })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(result => {
                    if (result.status) {
                        alert(result.message);
                        window.location.href = "/dashboard"; 
                    } else {
                        alert("Verification failed: " + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Something went wrong with the verification.");
                });
            },
            "modal": {
                "ondismiss": function(){
                    alert('Payment cancelled by user');
                }
            },
            "theme": {
                "color": "#0d6efd" 
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    });
});
</script>