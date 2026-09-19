<div class="{{ $class ?? 'text-center mb-4' }}" data-animate="fade-up">
    <span class="section-kicker"><i class="{{ $icon ?? 'fa-solid fa-compass' }}"></i> {{ $kicker }}</span>
    <h2 class="section-title">{{ $title }}</h2>
    @isset($text)
        <p class="section-text {{ !isset($class) ? 'mx-auto' : '' }}">{{ $text }}</p>
    @endisset
</div>
