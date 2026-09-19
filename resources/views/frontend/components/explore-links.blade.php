<nav class="travel-discovery-links" aria-label="Popular holiday searches">
    <span class="travel-discovery-label"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Popular searches</span>
    <a href="{{ route('frontend.domestic', ['filters' => encrypted_query(['category' => 'family'])]) }}">Family holidays</a>
    <a href="{{ route('frontend.international', ['filters' => encrypted_query(['category' => 'couple'])]) }}">Honeymoon escapes</a>
    <a href="{{ route('frontend.domestic', ['filters' => encrypted_query(['budget' => '15-30'])]) }}">Trips under ₹40K</a>
    <a href="{{ route('frontend.international') }}">International tours</a>
    <a href="{{ route('frontend.destinations') }}">Explore all destinations</a>
</nav>
