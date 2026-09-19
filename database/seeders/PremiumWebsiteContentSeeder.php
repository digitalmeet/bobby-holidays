<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Database\Seeder;
use LogicException;

class PremiumWebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production') && ! config('demo.allow_seed')) {
            throw new LogicException('Website demo content seeding is disabled in production.');
        }

        $this->seedDestinations();
        $this->seedTours();
        $this->seedPagesAndServices();
        $this->seedJournal();
        $this->seedTrustContent();
        $this->seedSeoSettings();

        $this->command?->info('Premium website content applied.');
    }

    private function seedDestinations(): void
    {
        $destinations = [
            'kashmir' => [
                'short_description' => 'Himalayan valleys, Dal Lake houseboats and alpine day trips, planned around the season and your preferred pace.',
                'description' => '<p>Kashmir rewards travellers who leave space to absorb the landscape. Base your journey around Srinagar, then add Gulmarg and Pahalgam for mountain views, meadow walks and seasonal snow experiences.</p><p>We help balance driving time with local experiences, selecting stays and excursions that suit families, couples and multi-generation groups.</p>',
                'highlights' => [['highlight' => 'Dal Lake shikara ride and carefully selected houseboat stay'], ['highlight' => 'Season-sensitive planning for Gulmarg and Pahalgam'], ['highlight' => 'Private transfers with realistic travel times']],
                'meta_title' => 'Kashmir Holiday Packages & Travel Guide | UniWorld Holidays',
                'meta_description' => 'Plan a personalised Kashmir holiday covering Srinagar, Gulmarg and Pahalgam with curated stays, private transfers and practical seasonal guidance.',
            ],
            'goa' => [
                'short_description' => 'A flexible coastal escape combining well-located stays, beaches, heritage neighbourhoods and unhurried evenings.',
                'description' => '<p>Goa is more rewarding when the itinerary reflects the kind of coast you enjoy. Choose North Goa for energy and entertainment, South Goa for quieter resorts, or combine both with Old Goa and Panaji.</p><p>We recommend the right beach belt, hotel style and transfer plan for couples, families, friends and short celebrations.</p>',
                'highlights' => [['highlight' => 'Hotel options matched to the right beach neighbourhood'], ['highlight' => 'Portuguese heritage and Panaji walking experiences'], ['highlight' => 'Flexible leisure time for dining and sunsets']],
                'meta_title' => 'Goa Holiday Packages & Beach Escapes | UniWorld Holidays',
                'meta_description' => 'Design a Goa holiday with the right beach area, curated hotel, private transfers and optional heritage and water-sport experiences.',
            ],
            'kerala' => [
                'short_description' => 'Tea-country scenery, wildlife, backwaters and the coast connected through a comfortable, thoughtfully paced route.',
                'description' => '<p>Kerala brings together distinct landscapes within one journey—from Munnar and Thekkady to Alleppey, Kumarakom and the coast. The best routes account for road conditions and avoid packing too many stops into each day.</p><p>We shape the itinerary around nature, wellness, food and family interests, with appropriate stays at every stage.</p>',
                'highlights' => [['highlight' => 'Munnar tea country and scenic drives'], ['highlight' => 'Private backwater or houseboat experience'], ['highlight' => 'Route planning that limits unnecessary hotel changes']],
                'meta_title' => 'Kerala Holiday Packages & Backwater Tours | UniWorld Holidays',
                'meta_description' => 'Explore Kerala with a personalised route through Munnar, Thekkady and the backwaters, including curated stays and private transfers.',
            ],
            'rajasthan' => [
                'short_description' => 'Forts, palaces, desert landscapes and living culture woven into an elegant, well-paced private journey.',
                'description' => '<p>Rajasthan offers extraordinary variety across Jaipur, Jodhpur, Udaipur, Jaisalmer and smaller heritage towns. A considered circuit balances landmark visits with local markets, regional cuisine and time within characterful hotels.</p><p>We select the route according to your available days rather than compressing every city into one hurried programme.</p>',
                'highlights' => [['highlight' => 'Private heritage sightseeing with local context'], ['highlight' => 'Palace, haveli and modern hotel options'], ['highlight' => 'Efficient city sequence with optional desert experiences']],
                'meta_title' => 'Rajasthan Holiday Packages & Private Tours | UniWorld Holidays',
                'meta_description' => 'Plan a private Rajasthan journey through Jaipur, Jodhpur, Udaipur and the desert with curated heritage stays and guided sightseeing.',
            ],
            'dubai' => [
                'short_description' => 'Contemporary landmarks, desert experiences and waterfront evenings arranged with efficient transfers and pre-booked access.',
                'description' => '<p>Dubai works equally well for first international holidays, family breaks and premium short stays. A balanced programme can combine Downtown landmarks, Old Dubai, the marina, a desert evening and relaxed time for dining or shopping.</p><p>We coordinate attraction timings and neighbourhood-based stays to reduce avoidable travel across the city.</p>',
                'highlights' => [['highlight' => 'Downtown Dubai and Burj Khalifa planning'], ['highlight' => 'Considered desert experience options'], ['highlight' => 'Family, couple and premium hotel categories']],
                'meta_title' => 'Dubai Holiday Packages from India | UniWorld Holidays',
                'meta_description' => 'Plan a personalised Dubai holiday with well-located hotels, airport transfers, city highlights and a carefully selected desert experience.',
            ],
            'bali' => [
                'short_description' => 'Temple landscapes, rice terraces and coastal stays combined in a calm itinerary for couples and curious travellers.',
                'description' => '<p>Bali is best experienced as more than one setting. Pair the culture and greenery of Ubud with a coastal stay in Seminyak, Nusa Dua, Uluwatu or Sanur according to your preferred atmosphere.</p><p>We plan transfers and experience days carefully so the journey remains restorative rather than over-scheduled.</p>',
                'highlights' => [['highlight' => 'Ubud culture, temples and rice-terrace landscapes'], ['highlight' => 'Coastal area selected for your travel style'], ['highlight' => 'Private villa and resort options for milestone trips']],
                'meta_title' => 'Bali Holiday & Honeymoon Packages | UniWorld Holidays',
                'meta_description' => 'Design a Bali holiday combining Ubud and the coast with curated villas, private transfers, temples and personalised couple experiences.',
            ],
            'maldives' => [
                'short_description' => 'Private-island stays selected by transfer type, villa category, meal plan, reef access and the experience you value most.',
                'description' => '<p>Choosing the right Maldives resort depends on more than the villa photograph. Transfer time, house reef, dining plan, island size and activity programme all shape the experience.</p><p>We compare these details clearly and recommend resorts that match your budget, celebration and preferred balance of privacy and activity.</p>',
                'highlights' => [['highlight' => 'Resort comparison by reef, meal plan and transfer type'], ['highlight' => 'Beach, overwater and split-stay villa options'], ['highlight' => 'Honeymoon and celebration inclusions where available']],
                'meta_title' => 'Maldives Resort & Honeymoon Packages | UniWorld Holidays',
                'meta_description' => 'Compare Maldives resorts and plan a personalised island holiday with suitable transfers, meal plans and beach or overwater villa options.',
            ],
        ];

        foreach ($destinations as $slug => $content) {
            Destination::query()->where('slug', $slug)->update($content);
        }
    }

    private function seedTours(): void
    {
        $tours = [
            'kashmir-valley-retreat' => [
                'subtitle' => 'Six days across Srinagar, Gulmarg and Pahalgam with private transfers and a measured family-friendly pace.',
                'overview' => '<p>This private Kashmir journey connects the valley’s essential experiences without turning every day into a long checklist. Begin beside Dal Lake, spend time among Srinagar’s gardens, and take scenic day journeys to Gulmarg and Pahalgam.</p><p>Hotel category, room combinations and seasonal activities can be adapted before confirmation.</p>',
                'meta_title' => '6-Day Kashmir Valley Holiday Package | UniWorld Holidays',
                'meta_description' => 'Explore Srinagar, Gulmarg and Pahalgam on a six-day private Kashmir itinerary with curated stays, transfers and flexible seasonal experiences.',
                'days' => ['Arrive in Srinagar and settle beside Dal Lake', 'Srinagar gardens, old city and shikara experience', 'Gulmarg mountain excursion', 'Travel to Pahalgam through the valley', 'Pahalgam scenery and flexible local exploration', 'Return transfer and departure'],
            ],
            'goa-coastal-escape' => [
                'subtitle' => 'Four relaxed days with a well-located coastal stay, private airport transfers and time to experience Goa your way.',
                'overview' => '<p>A short Goa break should feel spacious, not rushed. This flexible escape combines a carefully chosen beach area with an optional heritage drive, water activities and generous time for restaurants, cafés and the coast.</p>',
                'meta_title' => '4-Day Goa Coastal Holiday Package | UniWorld Holidays',
                'meta_description' => 'Plan a four-day Goa escape with a curated beach hotel, private airport transfers and optional heritage, dining and water-sport experiences.',
                'days' => ['Arrival and private transfer to your coastal stay', 'North or South Goa experience based on your hotel area', 'Heritage, water activities or an unhurried leisure day', 'Breakfast and airport departure'],
            ],
            'kerala-backwater-journey' => [
                'subtitle' => 'A six-day route through Munnar, Thekkady and the backwaters, designed to balance scenery, culture and rest.',
                'overview' => '<p>This Kerala journey moves from the tea-covered hills of Munnar to the spice country around Thekkady and a quiet backwater finale. Private transfers and sensible departure times keep the route comfortable.</p>',
                'meta_title' => '6-Day Kerala Backwater Holiday Package | UniWorld Holidays',
                'meta_description' => 'Travel through Munnar, Thekkady and Kerala’s backwaters on a six-day private itinerary with curated hotels and comfortable transfers.',
                'days' => ['Arrival in Kochi and scenic drive to Munnar', 'Munnar tea country and viewpoints', 'Travel to Thekkady and spice-region experience', 'Nature, culture and optional activities in Thekkady', 'Backwater stay in Alleppey or Kumarakom', 'Kochi transfer and departure'],
            ],
            'royal-rajasthan-circuit' => [
                'subtitle' => 'Eight days of forts, palaces, regional cuisine and heritage stays across a carefully sequenced Rajasthan route.',
                'overview' => '<p>A private cultural circuit linking Jaipur, Jodhpur and Udaipur with guided landmark visits and space for markets, local food and hotel experiences. The route can be extended to Jaisalmer or shortened around your flights.</p>',
                'meta_title' => '8-Day Royal Rajasthan Private Tour | UniWorld Holidays',
                'meta_description' => 'Discover Jaipur, Jodhpur and Udaipur on an eight-day private Rajasthan tour with heritage stays, guided sightseeing and flexible extensions.',
                'days' => ['Arrive in Jaipur', 'Amber Fort and Jaipur heritage', 'Markets, museums and a flexible Jaipur afternoon', 'Drive to Jodhpur', 'Mehrangarh Fort and the Blue City', 'Travel to Udaipur', 'Udaipur palaces, lake and old city', 'Departure or onward extension'],
            ],
            'dubai-signature-experience' => [
                'subtitle' => 'Five well-planned days combining modern Dubai, the old city, a desert evening and waterfront leisure.',
                'overview' => '<p>Designed for first-time and returning visitors, this Dubai itinerary groups experiences by area to make better use of each day. Attraction levels, hotel neighbourhood and free time can all be tailored.</p>',
                'meta_title' => '5-Day Dubai Holiday Package from India | UniWorld Holidays',
                'meta_description' => 'Experience Downtown Dubai, the old city, marina and desert on a five-day holiday with coordinated hotel, transfers and attraction planning.',
                'days' => ['Arrival and private hotel transfer', 'Old Dubai, Creek and contemporary city highlights', 'Downtown Dubai and Burj Khalifa district', 'Flexible morning and considered desert experience', 'Breakfast and airport departure'],
            ],
            'romantic-bali-hideaway' => [
                'subtitle' => 'Six days pairing Ubud’s cultural landscape with a coastal retreat and thoughtful time for two.',
                'overview' => '<p>This couple-focused Bali journey combines inland scenery, temples and local culture with a relaxed coastal stay. Villa category, celebration arrangements and activity level can be personalised.</p>',
                'meta_title' => '6-Day Bali Honeymoon & Couple Package | UniWorld Holidays',
                'meta_description' => 'Combine Ubud and the Bali coast on a six-day couple holiday with private transfers, curated villas, temples and flexible romantic experiences.',
                'days' => ['Arrival and private transfer to Ubud', 'Ubud culture, craft and rice-terrace landscapes', 'Temple and countryside experience', 'Transfer to your selected coastal area', 'Leisure, spa or optional island experience', 'Private transfer and departure'],
            ],
            'maldives-overwater-luxury' => [
                'subtitle' => 'Five days at a carefully matched private-island resort with an overwater stay and a clear meal-plan choice.',
                'overview' => '<p>A refined Maldives escape built around the resort rather than a generic package. We compare transfer method, lagoon, reef access, dining, villa privacy and included activities before recommending the right island.</p>',
                'meta_title' => '5-Day Maldives Overwater Villa Package | UniWorld Holidays',
                'meta_description' => 'Plan a five-day Maldives resort holiday with an overwater villa, suitable meal plan, island transfers and personalised celebration options.',
                'days' => ['Arrive in Malé and transfer to your island resort', 'Lagoon leisure and resort experiences', 'Snorkelling, spa or optional marine activity', 'Unhurried island day and sunset experience', 'Resort checkout and airport transfer'],
            ],
        ];

        foreach ($tours as $slug => $content) {
            $days = collect($content['days'])->map(fn (string $title, int $index): array => [
                'day' => $index + 1,
                'title' => $title,
                'description' => $index === 0
                    ? 'Meet your transfer representative, continue to your stay and review the journey ahead.'
                    : ($index === count($content['days']) - 1
                        ? 'Check out after breakfast and continue to the airport or your onward arrangement.'
                        : 'A thoughtfully paced day with confirmed services and appropriate time at leisure.'),
                'meals' => 'Breakfast',
                'accommodation' => $index < count($content['days']) - 1 ? 'Selected hotel or resort' : '',
            ])->all();

            unset($content['days']);
            $content['itinerary'] = $days;
            Tour::query()->where('slug', $slug)->update($content);
        }
    }

    private function seedPagesAndServices(): void
    {
        $this->upsertPage('about-us', [
            'type' => 'page',
            'title' => 'Travel Planning Built Around You',
            'short_description' => 'Personalised holidays, explained clearly and coordinated by one accountable travel team.',
            'content' => '<h2>A more considered way to plan</h2><p>UniWorld Holidays designs journeys for families, couples, groups and organisations across India and selected international destinations. We begin by understanding who is travelling, what matters to them and how they want each day to feel.</p><h3>Clarity before commitment</h3><p>Your proposal sets out the route, stay category, inclusions, exclusions and payment schedule so you can make an informed decision. Where options exist, we explain the practical trade-offs rather than presenting a one-size-fits-all package.</p><h3>Support that stays connected</h3><p>Our planning and operations teams coordinate the journey from enquiry to return, including supplier confirmations and assistance when travel plans change.</p>',
            'meta_title' => 'About UniWorld Holidays | Personalised Travel Planning',
            'meta_description' => 'Learn how UniWorld Holidays creates personalised itineraries through thoughtful advice, clear proposals and dependable travel coordination.',
            'is_published' => true,
            'published_at' => now()->subMonth(),
        ]);

        foreach ([
            'gallery' => ['Travel Inspiration', 'A visual introduction to journeys across India and selected international destinations.'],
            'privacy-policy' => ['Privacy Policy', 'How UniWorld Holidays collects, uses and safeguards information shared for travel enquiries and bookings.'],
            'terms-conditions' => ['Booking Terms & Conditions', 'The booking, payment, cancellation and traveller responsibilities that apply to UniWorld Holidays services.'],
        ] as $slug => [$title, $description]) {
            $this->upsertPage($slug, [
                'type' => 'page',
                'title' => $title,
                'short_description' => $description,
                'content' => '<p>'.$description.'</p>',
                'meta_title' => "{$title} | UniWorld Holidays",
                'meta_description' => $description,
                'is_published' => true,
                'published_at' => now()->subMonth(),
            ]);
        }

        $services = [
            'holiday-packages' => ['Holiday Planning', 'Tailor-made India and international journeys designed around your dates, interests, pace and preferred investment.', '<h2>Travel designed around your priorities</h2><p>Begin with one of our proven routes or start with a blank page. We coordinate destination sequencing, hotel categories, transfers, experiences and leisure time into one coherent itinerary.</p><h3>What your proposal can include</h3><ul><li>Destination and seasonal guidance</li><li>Hotel and room-category options</li><li>Private or shared transfers</li><li>Guided visits and bookable experiences</li><li>Clear inclusions, exclusions and payment milestones</li></ul>'],
            'hotel-booking' => ['Curated Hotel Selection', 'Hotels, resorts and distinctive stays shortlisted for location, comfort, service standards and value.', '<h2>The right stay for the journey</h2><p>We evaluate more than the headline rate. Location, room layout, meal plan, transfer time and suitability for your party all influence the recommendation.</p><h3>Stay categories</h3><ul><li>Reliable value and comfort hotels</li><li>Premium city and resort properties</li><li>Heritage stays, villas and houseboats</li><li>Family rooms and connected-room options</li><li>Celebration and honeymoon upgrades where available</li></ul>'],
            'flights' => ['Flight Planning', 'Domestic and international flight options aligned with your itinerary, baggage needs, connections and arrival times.', '<h2>Flights that work with the complete plan</h2><p>We compare practical routing, total journey time, baggage allowance and change conditions—not only the lowest displayed fare.</p><h3>Planning support</h3><ul><li>Domestic, international and multi-city routing</li><li>Connection and transit-time review</li><li>Baggage, seat and meal coordination where supported</li><li>Group fare enquiries</li><li>Rebooking assistance subject to airline rules</li></ul>'],
            'visa-assistance' => ['Visa Documentation Guidance', 'Destination-specific checklists, application review and appointment coordination for supported visa categories.', '<h2>Structured documentation support</h2><p>Visa decisions remain solely with the relevant embassy or immigration authority. Our role is to help you understand the current process and prepare an orderly application.</p><h3>Support may include</h3><ul><li>Application-specific document checklist</li><li>Form and supporting-document review</li><li>Appointment guidance where applicable</li><li>Status coordination through the authorised channel</li><li>Pre-departure document check</li></ul>'],
            'cruise' => ['Cruise Holidays', 'Cruise recommendations based on route, sailing date, cabin type, onboard style and traveller needs.', '<h2>Choose the right ship and sailing</h2><p>A cruise holiday is shaped by the ship, cabin, itinerary and fare conditions. We compare these elements and coordinate pre- or post-cruise stays where useful.</p><h3>Planning considerations</h3><ul><li>Suitable cruise line and ship style</li><li>Interior, ocean-view, balcony and suite cabins</li><li>Port schedule and optional shore experiences</li><li>Visa and embarkation guidance</li><li>Flights and hotel nights around the sailing</li></ul>'],
            'corporate-travel' => ['Corporate & MICE Travel', 'Accountable coordination for business trips, meetings, incentives, conferences and executive movements.', '<h2>Structured travel for organisations</h2><p>We coordinate business travel with clear ownership, documented approvals and practical support for travellers and organisers.</p><h3>Capabilities</h3><ul><li>Executive flight, hotel and transfer arrangements</li><li>Meetings and conference logistics</li><li>Incentive journeys and team offsites</li><li>Group movement and rooming-list coordination</li><li>GST-aligned documentation where applicable</li></ul>'],
            'travel-insurance' => ['Travel Insurance Guidance', 'Help comparing suitable travel insurance options for destination requirements and traveller circumstances.', '<h2>Protection suited to the journey</h2><p>Coverage, limits and exclusions vary by insurer and policy. We help identify relevant options, while the final policy wording remains the authoritative document.</p><h3>Areas to review</h3><ul><li>Emergency medical and evacuation cover</li><li>Trip cancellation or interruption benefits</li><li>Baggage loss and delay provisions</li><li>Age, activity and pre-existing-condition terms</li><li>Destination-specific insurance requirements</li></ul>'],
        ];

        foreach ($services as $index => $service) {
            [$title, $shortDescription, $content] = $service;
            $this->upsertPage($index, [
                'type' => 'service',
                'title' => $title,
                'short_description' => $shortDescription,
                'content' => $content,
                'meta_title' => "{$title} | UniWorld Holidays",
                'meta_description' => $shortDescription,
                'is_published' => true,
                'published_at' => now()->subMonth(),
            ]);
        }
    }

    private function upsertPage(string $slug, array $attributes): void
    {
        Page::withoutEvents(function () use ($slug, $attributes): void {
            $generatedSlug = str($attributes['title'] ?? $slug)->slug()->toString();
            $page = Page::query()
                ->where('slug', $slug)
                ->orWhere('slug', $generatedSlug)
                ->first() ?? new Page();

            $page->forceFill(['slug' => $slug] + $attributes)->save();
        });
    }

    private function seedJournal(): void
    {
        $posts = [
            'best-time-to-visit-kashmir' => [
                'title' => 'When to Visit Kashmir: A Season-by-Season Planning Guide',
                'excerpt' => 'Compare Kashmir’s spring gardens, summer valleys, autumn colour and winter snow before choosing travel dates.',
                'content' => '<p>Kashmir changes character throughout the year, so the best time to visit depends on the experience you value most.</p><h2>Spring: gardens and fresh landscapes</h2><p>March to early May brings flowering gardens and cool temperatures. Higher-altitude access can still depend on weather.</p><h2>Summer: comfortable valley exploration</h2><p>Late May to August is popular for family travel, meadow scenery and broader road access. Reserve preferred hotels early.</p><h2>Autumn and winter</h2><p>September and October offer crisp weather and changing foliage. Winter travellers should plan for cold conditions, possible road changes and snow-focused activities in Gulmarg.</p><h2>Before you confirm</h2><p>Review current weather, road access and activity operations close to departure. A flexible plan is especially valuable in mountain regions.</p>',
                'meta_title' => 'Best Time to Visit Kashmir: Seasonal Guide | UniWorld Holidays',
                'meta_description' => 'Compare spring, summer, autumn and winter travel in Kashmir, including weather, scenery, access and practical planning considerations.',
                'tags' => ['Kashmir', 'seasonal travel', 'India holidays'],
            ],
            'planning-a-maldives-honeymoon' => [
                'title' => 'How to Choose the Right Maldives Resort for Your Honeymoon',
                'excerpt' => 'A practical framework for comparing islands, villas, meal plans, transfers and honeymoon inclusions.',
                'content' => '<p>The right Maldives resort is the one that matches how you want to spend the holiday—not simply the property with the most dramatic photograph.</p><h2>Start with the island experience</h2><p>Consider island size, atmosphere, house-reef access, dining variety and the balance between privacy and organised activities.</p><h2>Compare the complete price</h2><p>Include speedboat or seaplane transfers, taxes, meal plan, selected activities and any villa supplements when comparing proposals.</p><h2>Choose the villa deliberately</h2><p>Beach villas offer direct sand access, while overwater villas provide lagoon views and privacy. A split stay can deliver both experiences if resort rules allow.</p><h2>Check the details</h2><p>Ask what honeymoon benefits require, which restaurants are included and how weather-related transfer changes are handled.</p>',
                'meta_title' => 'How to Choose a Maldives Honeymoon Resort | UniWorld Holidays',
                'meta_description' => 'Compare Maldives resorts by island style, villa, transfer, meal plan, reef and honeymoon inclusions before booking your trip.',
                'tags' => ['Maldives', 'honeymoon', 'resort planning'],
            ],
            'dubai-family-holiday-guide' => [
                'title' => 'Planning a Dubai Family Holiday Without Overloading the Itinerary',
                'excerpt' => 'Build a family-friendly Dubai plan around neighbourhoods, realistic attraction times and age-appropriate experiences.',
                'content' => '<p>Dubai offers more attractions than most families can comfortably fit into one visit. A better holiday begins by choosing priorities and grouping plans by area.</p><h2>Select a practical hotel location</h2><p>Downtown, the marina, Palm Jumeirah and older Dubai each create a different daily rhythm. Choose according to the attractions and evenings you value.</p><h2>Plan one major experience at a time</h2><p>Large attractions can take half a day. Leave buffers for meals, queues and the unexpected rather than stacking distant reservations.</p><h2>Choose the desert experience carefully</h2><p>Review drive time, vehicle arrangement, dune intensity, camp format and food requirements—especially with young children or older relatives.</p><h2>Book flexibly where possible</h2><p>Check change terms, attraction age rules and seasonal opening information before final payment.</p>',
                'meta_title' => 'Dubai Family Holiday Planning Guide | UniWorld Holidays',
                'meta_description' => 'Plan a well-paced Dubai family holiday with advice on hotel areas, attraction timing, desert experiences and practical booking decisions.',
                'tags' => ['Dubai', 'family holidays', 'travel planning'],
            ],
        ];

        foreach ($posts as $slug => $content) {
            Post::query()->where('slug', $slug)->update($content + ['read_time_minutes' => 6]);
        }
    }

    private function seedTrustContent(): void
    {
        Banner::query()->where('position', 'homepage_hero')->update([
            'title' => 'Journeys Designed Around You',
            'subtitle' => 'Personalised holidays, thoughtfully planned',
            'description' => 'Considered itineraries across India and selected international destinations, supported from enquiry to return.',
            'cta_text' => 'Explore Holidays',
        ]);

        $testimonials = [
            'Mehta Family' => 'The route worked beautifully for three generations. Transfer timings were clear, the hotels suited our family and the houseboat evening felt genuinely special.',
            'Riya & Dev' => 'The resort comparison helped us understand the real differences between meal plans and villa types. We chose confidently and every confirmed detail was delivered.',
            'Shah Family' => 'Our Dubai days were grouped intelligently, so we never felt rushed across the city. The desert experience and family hotel recommendation were exactly right for us.',
        ];

        foreach ($testimonials as $name => $content) {
            Testimonial::query()->where('name', $name)->update(['content' => $content]);
        }

        $faqs = [
            ['Can the itinerary be customised?', '<p>Yes. We can adjust the route, number of nights, hotel category, room requirements, transfers, sightseeing and free time before you confirm.</p>', 'Planning'],
            ['How much is required to confirm a booking?', '<p>The deposit depends on the fare and supplier conditions in your proposal. We show the exact payment schedule and non-refundable components before you pay.</p>', 'Payments'],
            ['Do you assist during the trip?', '<p>Confirmed travellers receive an operations contact for urgent coordination involving services booked through UniWorld Holidays.</p>', 'Support'],
            ['Are package prices final?', '<p>Displayed prices are indicative starting points. Your final proposal reflects travel dates, availability, party size, room type and selected inclusions.</p>', 'Pricing'],
            ['Can you arrange visas?', '<p>We provide documentation guidance and application coordination for supported destinations. Visa approval is solely at the discretion of the relevant authority.</p>', 'Documents'],
            ['What happens if I need to cancel?', '<p>Cancellation charges depend on the airline, hotel and other supplier terms accepted at confirmation. We explain applicable conditions in the proposal.</p>', 'Changes'],
            ['Is travel insurance included?', '<p>Insurance is included only when stated in the proposal. We recommend suitable cover and ask travellers to review policy limits and exclusions carefully.</p>', 'Documents'],
            ['When should I start planning?', '<p>For peak dates and international journeys, earlier planning usually provides better flight and hotel choice. Complex group travel may require additional lead time.</p>', 'Planning'],
        ];

        foreach ($faqs as $index => [$question, $answer, $category]) {
            Faq::updateOrCreate(['question' => $question], [
                'answer' => $answer,
                'category' => $category,
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }

    private function seedSeoSettings(): void
    {
        foreach ([
            'company_tagline' => 'Personalised holidays, thoughtfully planned',
            'seo_title' => 'Tailor-Made India & International Holidays | UniWorld Holidays',
            'seo_description' => 'Plan personalised holidays across India and selected international destinations with considered itineraries, clear proposals and dependable travel support.',
        ] as $key => $value) {
            Setting::updateOrCreate(['key' => $key], [
                'value' => $value,
                'type' => 'text',
                'group' => $key === 'company_tagline' ? 'company' : 'seo',
                'label' => str($key)->replace('_', ' ')->title()->toString(),
            ]);
        }
    }
}
