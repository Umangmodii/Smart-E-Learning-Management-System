<div>
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
    <div class="container py-2">
        <div class="mb-4">
            <h2 class="h3 fw-bold text-dark">{{ $category->name }} Courses</h2>
            <p class="text-secondary mb-0">
                Explore courses from experienced, real-world experts to get you started.
            </p>
        </div>
    </div>
</div>