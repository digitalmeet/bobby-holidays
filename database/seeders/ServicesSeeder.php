<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug'              => 'holiday-packages',
                'title'             => 'Holiday Packages',
                'icon'              => 'fa-solid fa-suitcase-rolling',
                'short_description' => 'Curated domestic and international packages designed for families, couples, and groups.',
                'content'           => '<h3>Tailored Holiday Experiences</h3><p>Every traveller is different. Our holiday packages are designed around your preferences — whether you seek adventure, relaxation, cultural immersion, or a blend of everything.</p><h4>What We Offer</h4><ul><li>Domestic packages covering 50+ destinations across India</li><li>International packages to 30+ countries</li><li>Customisable itineraries for any group size</li><li>Budget, premium, and luxury tier options</li><li>All-inclusive packages with hotels, transfers, sightseeing, and meals</li></ul><h4>Popular Categories</h4><ul><li>Family holidays with child-friendly activities</li><li>Honeymoon packages with romantic inclusions</li><li>Group tours with shared departures</li><li>Solo travel with curated experiences</li><li>Weekend getaways for short breaks</li></ul><p>Every package includes dedicated trip coordination, 24/7 support during travel, and flexible payment options.</p>',
                'sort_order'        => 1,
            ],
            [
                'slug'              => 'hotel-booking',
                'title'             => 'Hotel Booking',
                'icon'              => 'fa-solid fa-hotel',
                'short_description' => 'Access to 10,000+ properties worldwide — from budget stays to five-star luxury.',
                'content'           => '<h3>The Right Stay for Every Journey</h3><p>Accommodation sets the tone for your entire trip. We partner with properties across every category to match your expectations and budget perfectly.</p><h4>Our Hotel Network</h4><ul><li>Budget hotels and guesthouses for value travellers</li><li>3-star and 4-star properties for comfortable stays</li><li>5-star luxury hotels and resorts</li><li>Boutique properties and heritage stays</li><li>Villas, houseboats, and unique accommodations</li></ul><h4>Why Book Through Us</h4><ul><li>Negotiated rates lower than online platforms</li><li>Room category upgrades when available</li><li>Direct hotel coordination for special requests</li><li>Group booking discounts</li><li>Verified reviews and property inspections</li></ul>',
                'sort_order'        => 2,
            ],
            [
                'slug'              => 'flights',
                'title'             => 'Flight Booking',
                'icon'              => 'fa-solid fa-plane',
                'short_description' => 'Domestic and international flights at competitive fares with flexible booking options.',
                'content'           => '<h3>Seamless Air Travel Arrangements</h3><p>We compare fares across all major airlines to find the best routes, timings, and prices that fit your travel plan.</p><h4>Services Include</h4><ul><li>Domestic flights across all Indian carriers</li><li>International flights with major global airlines</li><li>Multi-city and stopover routing</li><li>Group fare negotiations for 10+ passengers</li><li>Flexible rebooking assistance</li></ul><h4>Added Value</h4><ul><li>Seat selection and meal preferences arranged</li><li>Baggage upgrades coordinated</li><li>Transit visa guidance for connecting flights</li><li>Flight + hotel combo savings</li></ul>',
                'sort_order'        => 3,
            ],
            [
                'slug'              => 'visa-assistance',
                'title'             => 'Visa Assistance',
                'icon'              => 'fa-solid fa-passport',
                'short_description' => 'Complete documentation support for hassle-free international travel.',
                'content'           => '<h3>Stress-Free Visa Processing</h3><p>International travel documentation can be complex. Our visa team handles the entire process so you can focus on planning your trip.</p><h4>Countries We Cover</h4><ul><li>UAE, Singapore, Thailand, Malaysia, Indonesia</li><li>Europe (Schengen), UK, Australia, New Zealand</li><li>USA, Canada (guidance and documentation)</li><li>Japan, South Korea, Vietnam, Sri Lanka</li></ul><h4>Our Process</h4><ul><li>Document checklist tailored to your nationality and destination</li><li>Application form filling and review</li><li>Appointment scheduling at embassies/VFS centres</li><li>Application submission and tracking</li><li>Pre-travel documentation verification</li></ul><h4>Success Rate</h4><p>We maintain a 97% visa approval rate through meticulous documentation preparation and pre-submission review.</p>',
                'sort_order'        => 4,
            ],
            [
                'slug'              => 'cruise',
                'title'             => 'Cruise Holidays',
                'icon'              => 'fa-solid fa-ship',
                'short_description' => 'Luxury cruise experiences on international waters with all-inclusive packages.',
                'content'           => '<h3>Sailing in Comfort and Style</h3><p>Cruise holidays offer a unique combination of luxury accommodation, world-class dining, entertainment, and multi-destination exploration — all without unpacking once.</p><h4>Cruise Lines We Work With</h4><ul><li>Royal Caribbean International</li><li>Costa Cruises</li><li>MSC Cruises</li><li>Norwegian Cruise Line</li><li>Cordelia Cruises (India)</li></ul><h4>Popular Routes</h4><ul><li>Mumbai to Goa coastal cruise</li><li>Singapore to Malaysia</li><li>Mediterranean circuit (Barcelona, Rome, Athens)</li><li>Dubai and Arabian Gulf</li><li>Alaska and Caribbean (seasonal)</li></ul><h4>What Is Included</h4><ul><li>Cabin accommodation (interior to balcony suites)</li><li>All meals and entertainment onboard</li><li>Port excursions (optional add-on)</li><li>Pre and post cruise hotel stays</li></ul>',
                'sort_order'        => 5,
            ],
            [
                'slug'              => 'corporate-travel',
                'title'             => 'Corporate & MICE',
                'icon'              => 'fa-solid fa-building',
                'short_description' => 'End-to-end business travel management, conferences, incentive trips, and team outings.',
                'content'           => '<h3>Business Travel Solutions</h3><p>From individual business trips to large-scale corporate events, we provide structured travel management that saves time and reduces costs.</p><h4>Services</h4><ul><li>Corporate flight and hotel bookings with negotiated rates</li><li>Conference and seminar travel arrangements</li><li>Incentive trips and reward holidays for teams</li><li>Team outings and offsite planning</li><li>Executive travel with VIP handling</li></ul><h4>MICE Expertise</h4><ul><li><strong>Meetings</strong> — Boardroom to ballroom, any scale</li><li><strong>Incentives</strong> — Reward top performers with memorable experiences</li><li><strong>Conferences</strong> — Venue sourcing, logistics, delegate management</li><li><strong>Events</strong> — Product launches, gala dinners, networking events</li></ul><h4>Why Companies Choose Us</h4><ul><li>Single point of contact for all travel needs</li><li>GST-compliant invoicing</li><li>Monthly MIS reports and expense tracking</li><li>24/7 emergency support for travelling employees</li></ul>',
                'sort_order'        => 6,
            ],
            [
                'slug'              => 'travel-insurance',
                'title'             => 'Travel Insurance',
                'icon'              => 'fa-solid fa-shield-halved',
                'short_description' => 'Comprehensive coverage for medical emergencies, trip cancellation, and baggage protection.',
                'content'           => '<h3>Travel With Confidence</h3><p>Unforeseen events can disrupt even the best-planned trips. Travel insurance provides financial protection and peace of mind throughout your journey.</p><h4>Coverage Includes</h4><ul><li>Medical expenses and hospitalisation abroad</li><li>Emergency medical evacuation</li><li>Trip cancellation and interruption</li><li>Baggage loss, theft, or delay</li><li>Flight delay compensation</li><li>Personal liability coverage</li></ul><h4>Plans Available</h4><ul><li>Individual traveller plans</li><li>Family plans (discounted group rates)</li><li>Senior citizen plans with enhanced medical cover</li><li>Adventure sports add-on coverage</li><li>Annual multi-trip plans for frequent travellers</li></ul><p>We partner with leading insurers to offer plans starting from just INR 500 per trip.</p>',
                'sort_order'        => 7,
            ],
        ];

        foreach ($services as $service) {
            DB::table('pages')->updateOrInsert(
                ['slug' => $service['slug']],
                [
                    'type'              => 'service',
                    'sort_order'        => $service['sort_order'],
                    'icon'              => $service['icon'],
                    'title'             => $service['title'],
                    'short_description' => $service['short_description'],
                    'content'           => $service['content'],
                    'is_published'      => true,
                    'published_at'      => now(),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]
            );
        }
    }
}
