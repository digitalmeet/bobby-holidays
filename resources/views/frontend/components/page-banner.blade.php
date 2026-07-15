<nav class="breadcrumb-strip" aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}"><i class="fa-solid fa-house"></i></a></li>
            @if(!empty($subtitle))
                <li class="breadcrumb-item">{{ $subtitle }}</li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </div>
</nav>
