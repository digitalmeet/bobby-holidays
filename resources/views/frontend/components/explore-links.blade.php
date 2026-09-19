<nav class="travel-discovery-links" aria-label="Popular holiday searches">
    <span class="travel-discovery-label"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Popular searches</span>
    <a href="{{ route('frontend.domestic', ['category' => 'family']) }}">Family holidays</a>
    <a href="{{ route('frontend.international', ['category' => 'honeymoon']) }}">Honeymoon escapes</a>
    <a href="{{ route('frontend.domestic', ['budget' => '20-40']) }}">Trips under ₹40K</a>
    <a href="{{ route('frontend.international') }}">International tours</a>
    <a href="{{ route('frontend.destinations') }}">Explore all destinations</a>
</nav>
