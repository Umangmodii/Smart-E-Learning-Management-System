<div class="container py-5">
    <div class="row align-items-center mb-5">

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

        <div class="col-lg-6">
            <h1 class="display-4 fw-bold text-dark">Come teach <br><span class="text-primary">with us</span></h1>
            <p class="lead text-muted">Become an instructor and change lives — including your own.</p>
            
         
                <a href="{{ url('instructor/register') }}?mode=instructor" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Get Started</a>
         
        </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('instructor/instructor_teach.jpg') }}" class="img-fluid rounded-4 shadow" alt="Teaching">
            </div>
    </div>

    <div class="row g-4 text-center mt-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <i class="bi bi-lightbulb text-warning fs-1"></i>
                <h4 class="fw-bold mt-3">Plan your curriculum</h4>
                <p class="small text-muted">You start with your passion and knowledge. We help you build the course.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <i class="bi bi-camera-video text-danger fs-1"></i>
                <h4 class="fw-bold mt-3">Record your video</h4>
                <p class="small text-muted">Use our high-end uploader tools to host your content securely.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <i class="bi bi-graph-up-arrow text-success fs-1"></i>
                <h4 class="fw-bold mt-3">Launch your course</h4>
                <p class="small text-muted">Submit for Admin review and start earning money from day one.</p>
            </div>
        </div>
    </div>
</div>