<section id="holiday-search" class="search-panel">
    <div class="container">
        <form class="search-box" action="{{ route('frontend.contact') }}" method="get" data-animate="fade-up">
            <div class="row g-3 align-items-end">
                <div class="col-lg-3 col-md-6">
                    <label class="form-label" for="destination">Destination</label>
                    <select class="form-select destination-select" id="destination" name="destination">
                        <option value="">Where to?</option>
                        <option>Goa</option>
                        <option>Kashmir</option>
                        <option>Kerala</option>
                        <option>Dubai</option>
                        <option>Bali</option>
                        <option>Singapore</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label" for="travel_date">Travel Date</label>
                    <input class="form-control date-picker" id="travel_date" name="travel_date" type="text" placeholder="Select date">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="guests">Guests</label>
                    <select class="form-select" id="guests" name="adults">
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                        <option value="5">5+ Guests</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label" for="budget">Budget</label>
                    <select class="form-select" id="budget" name="budget_range">
                        <option value="">Any Budget</option>
                        <option value="Under ₹50,000">Under 50k</option>
                        <option value="₹50,000 - ₹1,00,000">50k - 1L</option>
                        <option value="Above ₹1,00,000">1L+</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button class="btn-brand btn-accent w-100" type="submit"><i class="fa-solid fa-wand-magic-sparkles"></i> Plan My Trip</button>
                </div>
            </div>
        </form>
    </div>
</section>
