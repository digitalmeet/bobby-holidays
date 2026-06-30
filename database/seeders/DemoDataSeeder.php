<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\FollowUp;
use App\Models\Page;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\QuotationSection;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourPricing;
use App\Models\Traveller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌍 Seeding destinations...');
        $destinations = $this->seedDestinations();

        $this->command->info('🗺️ Seeding tours...');
        $tours = $this->seedTours($destinations);

        $this->command->info('📋 Seeding enquiries...');
        $enquiries = $this->seedEnquiries($destinations, $tours);

        $this->command->info('📞 Seeding follow-ups...');
        $this->seedFollowUps($enquiries);

        $this->command->info('📄 Seeding quotations...');
        $quotations = $this->seedQuotations($enquiries);

        $this->command->info('🎫 Seeding bookings...');
        $this->seedBookings($quotations, $tours);

        $this->command->info('⭐ Seeding testimonials...');
        $this->seedTestimonials($tours);

        $this->command->info('📝 Seeding blog posts...');
        $this->seedPosts();

        $this->command->info('📄 Seeding CMS pages...');
        $this->seedPages();

        $this->command->info('❓ Seeding FAQs...');
        $this->seedFaqs();

        $this->command->info('👥 Seeding staff users...');
        $this->seedStaffUsers();

        $this->command->info('⚙️ Seeding settings...');
        $this->seedSettings();

        $this->command->info('✅ Demo data seeded successfully!');
    }

    private function seedDestinations(): array
    {
        $data = [
            ['name' => 'Kashmir', 'country' => 'India', 'continent' => 'Domestic', 'short_description' => 'Paradise on Earth — snow-capped mountains, Dal Lake houseboats, and lush valleys.', 'is_featured' => true],
            ['name' => 'Goa', 'country' => 'India', 'continent' => 'Domestic', 'short_description' => 'Sun, sand, and seafood — India\'s favourite beach destination.', 'is_featured' => true],
            ['name' => 'Kerala', 'country' => 'India', 'continent' => 'Domestic', 'short_description' => 'God\'s Own Country — backwaters, tea gardens, and Ayurveda.', 'is_featured' => true],
            ['name' => 'Himachal Pradesh', 'country' => 'India', 'continent' => 'Domestic', 'short_description' => 'Mountain retreats — Shimla, Manali, Dharamshala, and apple orchards.', 'is_featured' => false],
            ['name' => 'Rajasthan', 'country' => 'India', 'continent' => 'Domestic', 'short_description' => 'Royal heritage — forts, palaces, desert safaris, and colourful culture.', 'is_featured' => true],
            ['name' => 'Dubai', 'country' => 'UAE', 'continent' => 'Middle East', 'short_description' => 'Luxury shopping, desert adventures, and stunning architecture.', 'is_featured' => true],
            ['name' => 'Bali', 'country' => 'Indonesia', 'continent' => 'Asia', 'short_description' => 'Tropical paradise — temples, rice terraces, beaches, and romance.', 'is_featured' => true],
            ['name' => 'Singapore', 'country' => 'Singapore', 'continent' => 'Asia', 'short_description' => 'Garden city — family attractions, food, and modern architecture.', 'is_featured' => false],
            ['name' => 'Thailand', 'country' => 'Thailand', 'continent' => 'Asia', 'short_description' => 'Temples, beaches, street food, and vibrant nightlife.', 'is_featured' => false],
            ['name' => 'Maldives', 'country' => 'Maldives', 'continent' => 'Asia', 'short_description' => 'Overwater villas, crystal-clear waters, and ultimate luxury.', 'is_featured' => true],
        ];

        $destinations = [];
        foreach ($data as $i => $item) {
            $destinations[] = Destination::create(array_merge($item, [
                'is_active' => true,
                'sort_order' => $i,
                'highlights' => [['highlight' => 'Stunning views'], ['highlight' => 'Local cuisine'], ['highlight' => 'Cultural experiences']],
            ]));
        }
        return $destinations;
    }

    private function seedTours(array $destinations): array
    {
        $tours = [];
        $tourData = [
            ['dest' => 0, 'title' => 'Kashmir Delight', 'category' => 'family', 'days' => 6, 'nights' => 5, 'price' => 24999],
            ['dest' => 0, 'title' => 'Kashmir Honeymoon Special', 'category' => 'honeymoon', 'days' => 5, 'nights' => 4, 'price' => 32999],
            ['dest' => 1, 'title' => 'Goa Beach Carnival', 'category' => 'adventure', 'days' => 4, 'nights' => 3, 'price' => 15999],
            ['dest' => 2, 'title' => 'Kerala Backwater Bliss', 'category' => 'family', 'days' => 6, 'nights' => 5, 'price' => 28999],
            ['dest' => 2, 'title' => 'Munnar & Alleppey Romance', 'category' => 'honeymoon', 'days' => 5, 'nights' => 4, 'price' => 26999],
            ['dest' => 3, 'title' => 'Shimla Manali Adventure', 'category' => 'adventure', 'days' => 7, 'nights' => 6, 'price' => 21999],
            ['dest' => 4, 'title' => 'Royal Rajasthan Circuit', 'category' => 'luxury', 'days' => 8, 'nights' => 7, 'price' => 45999],
            ['dest' => 5, 'title' => 'Dubai Explorer', 'category' => 'family', 'days' => 5, 'nights' => 4, 'price' => 49999],
            ['dest' => 5, 'title' => 'Dubai Luxury Escape', 'category' => 'luxury', 'days' => 6, 'nights' => 5, 'price' => 89999],
            ['dest' => 6, 'title' => 'Romantic Bali', 'category' => 'honeymoon', 'days' => 6, 'nights' => 5, 'price' => 64999],
            ['dest' => 7, 'title' => 'Singapore Family Fun', 'category' => 'family', 'days' => 5, 'nights' => 4, 'price' => 59999],
            ['dest' => 8, 'title' => 'Thailand Highlights', 'category' => 'adventure', 'days' => 6, 'nights' => 5, 'price' => 39999],
            ['dest' => 9, 'title' => 'Maldives Overwater Villa', 'category' => 'luxury', 'days' => 5, 'nights' => 4, 'price' => 149999],
        ];

        foreach ($tourData as $i => $item) {
            $tour = Tour::create([
                'destination_id' => $destinations[$item['dest']]->id,
                'title' => $item['title'],
                'subtitle' => "Best of {$destinations[$item['dest']]->name}",
                'category' => $item['category'],
                'duration_days' => $item['days'],
                'duration_nights' => $item['nights'],
                'starting_price' => $item['price'],
                'price_type' => 'per_person',
                'overview' => "<p>Experience the best of {$destinations[$item['dest']]->name} with our carefully curated {$item['nights']}-night package. Includes comfortable accommodation, all transfers, sightseeing, and memorable experiences.</p>",
                'highlights' => [['text' => 'Comfortable hotels'], ['text' => 'All transfers included'], ['text' => 'Expert local guides'], ['text' => 'Sightseeing as per itinerary']],
                'inclusions' => [['text' => 'Hotel accommodation'], ['text' => 'Daily breakfast'], ['text' => 'Airport/station transfers'], ['text' => 'Sightseeing by private cab']],
                'exclusions' => [['text' => 'Airfare/train tickets'], ['text' => 'Lunch and dinner'], ['text' => 'Personal expenses'], ['text' => 'Travel insurance']],
                'itinerary' => $this->generateItinerary($item['days'], $destinations[$item['dest']]->name),
                'is_featured' => $i < 6,
                'is_active' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'sort_order' => $i,
                'min_group_size' => 2,
                'max_group_size' => 20,
            ]);

            // Add pricing tiers
            TourPricing::create(['tour_id' => $tour->id, 'label' => 'Standard', 'price_per_person' => $item['price'], 'child_price' => round($item['price'] * 0.7), 'infant_price' => 0, 'is_active' => true, 'sort_order' => 0]);
            TourPricing::create(['tour_id' => $tour->id, 'label' => 'Deluxe', 'price_per_person' => round($item['price'] * 1.4), 'child_price' => round($item['price'] * 1.0), 'infant_price' => 0, 'is_active' => true, 'sort_order' => 1]);

            $tours[] = $tour;
        }
        return $tours;
    }

    private function generateItinerary(int $days, string $destination): array
    {
        $itinerary = [];
        for ($d = 1; $d <= $days; $d++) {
            $title = match ($d) {
                1 => "Arrival in {$destination}",
                $days => 'Departure',
                default => "Day {$d} — Sightseeing & Activities",
            };
            $itinerary[] = ['day' => $d, 'title' => $title, 'description' => "Day {$d} activities and sightseeing.", 'meals' => $d === 1 ? 'Dinner' : ($d === $days ? 'Breakfast' : 'Breakfast, Dinner'), 'accommodation' => $d < $days ? 'Hotel' : ''];
        }
        return $itinerary;
    }

    private function seedEnquiries(array $destinations, array $tours): array
    {
        $names = ['Rahul Sharma', 'Priya Patel', 'Amit Kumar', 'Sneha Gupta', 'Vikram Singh', 'Anita Desai', 'Rajesh Mehta', 'Pooja Verma', 'Suresh Nair', 'Kavita Joshi', 'Mohan Reddy', 'Neha Agarwal', 'Sanjay Thakur', 'Ritu Malhotra', 'Deepak Chauhan'];
        $sources = ['website', 'whatsapp', 'instagram', 'referral', 'facebook', 'walkin'];
        $statuses = ['new', 'new', 'new', 'contacted', 'contacted', 'quoted', 'quoted', 'converted', 'lost'];
        $admin = User::where('email', 'admin@uniworldholidays.com')->first();

        $enquiries = [];
        foreach ($names as $i => $name) {
            $status = $statuses[array_rand($statuses)];
            $enquiries[] = Enquiry::create([
                'name' => $name,
                'phone' => '+91 ' . rand(70000, 99999) . ' ' . rand(10000, 99999),
                'email' => strtolower(str_replace(' ', '.', $name)) . '@gmail.com',
                'destination_id' => $destinations[array_rand($destinations)]->id,
                'tour_id' => rand(0, 1) ? $tours[array_rand($tours)]->id : null,
                'travel_date' => now()->addDays(rand(15, 90)),
                'adults' => rand(1, 4),
                'children' => rand(0, 2),
                'infants' => rand(0, 1),
                'budget_range' => ['20,000 - 50,000', '50,000 - 1,00,000', '1,00,000 - 2,00,000', 'Above 2,00,000'][rand(0, 3)],
                'message' => 'Looking for a good package. Please share details.',
                'status' => $status,
                'source' => $sources[array_rand($sources)],
                'assigned_to' => $admin?->id,
                'follow_up_at' => in_array($status, ['new', 'contacted']) ? now()->addDays(rand(-3, 5)) : null,
                'last_contacted_at' => $status !== 'new' ? now()->subDays(rand(1, 7)) : null,
                'created_at' => now()->subDays(rand(0, 45)),
            ]);
        }
        return $enquiries;
    }

    private function seedFollowUps(array $enquiries): void
    {
        $admin = User::where('email', 'admin@uniworldholidays.com')->first();
        $types = ['call', 'whatsapp', 'call', 'call', 'email'];
        $statuses = ['completed', 'no_answer', 'busy', 'completed', 'callback'];

        foreach ($enquiries as $enquiry) {
            if (!in_array($enquiry->status, ['new', 'contacted', 'quoted'])) {
                continue;
            }

            // Past follow-ups (completed)
            $pastCount = rand(0, 3);
            for ($i = 0; $i < $pastCount; $i++) {
                FollowUp::create([
                    'enquiry_id' => $enquiry->id,
                    'created_by' => $admin?->id,
                    'type' => $types[array_rand($types)],
                    'status' => $statuses[array_rand($statuses)],
                    'notes' => ['Discussed requirements', 'Client will confirm dates', 'Shared quotation link', 'No response, will try again'][rand(0, 3)],
                    'scheduled_at' => now()->subDays(rand(1, 10))->setHour(rand(9, 17)),
                    'completed_at' => now()->subDays(rand(1, 10)),
                    'created_at' => now()->subDays(rand(1, 10)),
                ]);
            }

            // Today's scheduled calls
            if (rand(0, 2) === 0) {
                FollowUp::create([
                    'enquiry_id' => $enquiry->id,
                    'created_by' => $admin?->id,
                    'type' => 'call',
                    'status' => 'callback',
                    'scheduled_at' => today()->setHour(rand(9, 17))->setMinute(rand(0, 5) * 10),
                    'notes' => null,
                ]);
            }

            // Future follow-ups
            if (rand(0, 1)) {
                FollowUp::create([
                    'enquiry_id' => $enquiry->id,
                    'created_by' => $admin?->id,
                    'type' => 'call',
                    'status' => 'callback',
                    'scheduled_at' => now()->addDays(rand(1, 5))->setHour(rand(10, 16)),
                ]);
            }
        }
    }

    private function seedQuotations(array $enquiries): array
    {
        $quotations = [];
        $convertedEnquiries = array_filter($enquiries, fn ($e) => in_array($e->status, ['quoted', 'converted']));
        $admin = User::where('email', 'admin@uniworldholidays.com')->first();

        foreach (array_slice($convertedEnquiries, 0, 8) as $enquiry) {
            $total = rand(25000, 200000);
            $quotation = Quotation::create([
                'enquiry_id' => $enquiry->id,
                'client_name' => $enquiry->name,
                'client_email' => $enquiry->email,
                'client_phone' => $enquiry->phone,
                'title' => $enquiry->destination?->name . ' — ' . rand(4, 7) . 'N/' . rand(5, 8) . 'D Package',
                'travel_date' => $enquiry->travel_date,
                'return_date' => $enquiry->travel_date?->addDays(rand(4, 8)),
                'adults' => $enquiry->adults,
                'children' => $enquiry->children,
                'infants' => $enquiry->infants,
                'subtotal_amount' => $total,
                'discount_amount' => round($total * 0.05),
                'tax_amount' => round($total * 0.05),
                'total_amount' => $total,
                'validity_date' => now()->addDays(rand(-5, 15)),
                'status' => $enquiry->status === 'converted' ? 'accepted' : ['draft', 'sent', 'viewed'][rand(0, 2)],
                'prepared_by' => $admin?->id,
                'sent_at' => now()->subDays(rand(1, 10)),
                'version' => 1,
            ]);

            // Add items
            $section = QuotationSection::create(['quotation_id' => $quotation->id, 'title' => 'Accommodation', 'sort_order' => 0]);
            QuotationItem::create(['quotation_id' => $quotation->id, 'section_id' => $section->id, 'type' => 'accommodation', 'title' => 'Hotel Deluxe Room', 'nights' => rand(3, 6), 'unit_cost' => rand(3000, 8000), 'quantity' => $enquiry->adults, 'total_cost' => rand(15000, 50000), 'sort_order' => 0]);
            QuotationItem::create(['quotation_id' => $quotation->id, 'section_id' => null, 'type' => 'transfer', 'title' => 'Airport Transfers', 'unit_cost' => rand(2000, 5000), 'quantity' => 1, 'total_cost' => rand(2000, 5000), 'sort_order' => 1]);
            QuotationItem::create(['quotation_id' => $quotation->id, 'section_id' => null, 'type' => 'activity', 'title' => 'Sightseeing Package', 'unit_cost' => rand(1500, 4000), 'quantity' => $enquiry->adults, 'total_cost' => rand(5000, 20000), 'sort_order' => 2]);

            $quotations[] = $quotation;
        }
        return $quotations;
    }

    private function seedBookings(array $quotations, array $tours): void
    {
        $admin = User::where('email', 'admin@uniworldholidays.com')->first();
        $acceptedQuotations = array_filter($quotations, fn ($q) => $q->status === 'accepted');

        foreach (array_slice($acceptedQuotations, 0, 5) as $quotation) {
            $total = $quotation->total_amount;
            $paid = rand(0, 1) ? $total : round($total * rand(30, 80) / 100);
            $status = $paid >= $total ? 'fully_paid' : ($paid > 0 ? 'partial_paid' : 'confirmed');

            $booking = Booking::create([
                'quotation_id' => $quotation->id,
                'enquiry_id' => $quotation->enquiry_id,
                'tour_id' => $tours[array_rand($tours)]->id,
                'client_name' => $quotation->client_name,
                'client_email' => $quotation->client_email,
                'client_phone' => $quotation->client_phone,
                'travel_date' => $quotation->travel_date,
                'return_date' => $quotation->return_date,
                'adults' => $quotation->adults,
                'children' => $quotation->children,
                'infants' => $quotation->infants,
                'total_amount' => $total,
                'paid_amount' => $paid,
                'balance_amount' => max(0, $total - $paid),
                'status' => $status,
                'assigned_to' => $admin?->id,
            ]);

            // Add travellers
            for ($t = 0; $t < $quotation->adults; $t++) {
                Traveller::create([
                    'booking_id' => $booking->id,
                    'type' => 'adult',
                    'title' => ['Mr', 'Mrs', 'Ms'][rand(0, 2)],
                    'first_name' => ['Rahul', 'Priya', 'Amit', 'Sneha', 'Vikram'][rand(0, 4)],
                    'last_name' => ['Sharma', 'Patel', 'Kumar', 'Gupta', 'Singh'][rand(0, 4)],
                    'nationality' => 'Indian',
                ]);
            }

            // Add payments
            if ($paid > 0) {
                $methods = ['bank_transfer', 'upi', 'cash', 'credit_card'];
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $paid,
                    'method' => $methods[array_rand($methods)],
                    'payment_date' => now()->subDays(rand(1, 15)),
                    'status' => 'received',
                    'reference_number' => 'TXN' . rand(100000, 999999),
                    'recorded_by' => $admin?->id,
                ]);
            }
        }

        // Add a few more bookings without quotations (direct bookings)
        for ($i = 0; $i < 3; $i++) {
            $total = rand(20000, 80000);
            $paid = round($total * rand(50, 100) / 100);
            Booking::create([
                'tour_id' => $tours[array_rand($tours)]->id,
                'client_name' => ['Kiran Joshi', 'Manish Tiwari', 'Aarti Shah'][$i],
                'client_phone' => '+91 ' . rand(70000, 99999) . ' ' . rand(10000, 99999),
                'client_email' => ['kiran@email.com', 'manish@email.com', 'aarti@email.com'][$i],
                'travel_date' => now()->addDays(rand(5, 40)),
                'return_date' => now()->addDays(rand(9, 47)),
                'adults' => rand(2, 4),
                'children' => rand(0, 2),
                'total_amount' => $total,
                'paid_amount' => $paid,
                'balance_amount' => max(0, $total - $paid),
                'status' => $paid >= $total ? 'fully_paid' : 'partial_paid',
                'assigned_to' => $admin?->id,
            ]);
        }
    }

    private function seedTestimonials(array $tours): void
    {
        $testimonials = [
            ['name' => 'Mehta Family', 'location' => 'Mumbai', 'content' => 'The Dubai plan was smooth from pickup to sightseeing. We had enough time for family activities and relaxed evenings.', 'rating' => 5],
            ['name' => 'Rajesh & Priya', 'location' => 'Delhi', 'content' => 'Our Kashmir honeymoon was beautifully paced. Hotels, car, and sightseeing were handled with real attention.', 'rating' => 5],
            ['name' => 'Aarav & Nisha', 'location' => 'Bangalore', 'content' => 'The honeymoon inclusions in Bali were thoughtful, and the itinerary gave us enough private time.', 'rating' => 5],
            ['name' => 'Gupta Family', 'location' => 'Ahmedabad', 'content' => 'Kerala backwaters trip was a dream. The houseboat experience was unforgettable for our kids.', 'rating' => 4],
            ['name' => 'Sharma Family', 'location' => 'Pune', 'content' => 'Rajasthan circuit was well planned. Fort visits, camel safari, and hotel choices were excellent.', 'rating' => 5],
        ];

        foreach ($testimonials as $i => $item) {
            Testimonial::create(array_merge($item, [
                'tour_id' => $tours[array_rand($tours)]->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => $i,
            ]));
        }
    }

    private function seedPosts(): void
    {
        $posts = [
            ['title' => 'How to Plan a Family Holiday Without Stress', 'category' => 'planning', 'excerpt' => 'Simple ways to balance comfort, sightseeing, food preferences, and travel time for the whole family.'],
            ['title' => 'Visa Documents Travellers Should Prepare Early', 'category' => 'visa', 'excerpt' => 'A practical checklist for smoother international trip preparation and visa applications.'],
            ['title' => 'Best Honeymoon Ideas for Beach Lovers', 'category' => 'honeymoon', 'excerpt' => 'Beach destinations with privacy, romance, and memorable local experiences for newlyweds.'],
            ['title' => '10 Budget Travel Tips for Indian Families', 'category' => 'budget', 'excerpt' => 'Smart strategies to enjoy memorable holidays without breaking the bank.'],
            ['title' => 'Why Kashmir Should Be Your Next Destination', 'category' => 'destinations', 'excerpt' => 'From Dal Lake to Gulmarg — why every Indian should visit Kashmir at least once.'],
        ];

        foreach ($posts as $post) {
            Post::create(array_merge($post, [
                'content' => "<p>{$post['excerpt']}</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p><h3>Key Takeaways</h3><ul><li>Plan ahead for better deals</li><li>Book transfers in advance</li><li>Keep documents organised</li></ul><p>Contact UniWorld Holidays for a customised itinerary tailored to your needs and budget.</p>",
                'author_id' => User::first()?->id,
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'read_time_minutes' => rand(3, 8),
            ]));
        }
    }

    private function seedPages(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<h2>Welcome to UniWorld Holidays</h2>
<p>UniWorld Holidays is a premium travel planning company based in Ahmedabad, Gujarat. With over 12 years of expertise in crafting domestic and international holiday packages, we have served thousands of happy travellers across India.</p>

<h3>Our Story</h3>
<p>Founded with a passion for creating memorable travel experiences, UniWorld Holidays started as a small team dedicated to making travel accessible, comfortable, and personal. Today, we are a full-service travel agency offering holiday packages, hotel bookings, visa assistance, flight arrangements, and corporate travel solutions.</p>

<h3>Why Choose Us</h3>
<ul>
<li><strong>Personalised Itineraries</strong> — Every trip is tailored to your preferences, budget, and travel style.</li>
<li><strong>Experienced Team</strong> — Our travel consultants have first-hand knowledge of the destinations we recommend.</li>
<li><strong>24/7 Support</strong> — From booking to return, our team is available round the clock.</li>
<li><strong>Best Value</strong> — We negotiate the best rates with hotels, airlines, and activity providers.</li>
<li><strong>Trusted by Thousands</strong> — Over 5,000 families have travelled with us across 100+ destinations.</li>
</ul>

<h3>Our Services</h3>
<ul>
<li>Domestic & International Holiday Packages</li>
<li>Honeymoon & Couple Packages</li>
<li>Family & Group Tours</li>
<li>Corporate Travel & MICE</li>
<li>Hotel Booking</li>
<li>Flight Booking</li>
<li>Visa Assistance</li>
<li>Travel Insurance</li>
</ul>

<h3>Our Mission</h3>
<p>To make every journey memorable, stress-free, and within reach — whether it\'s a family vacation to Kashmir, a honeymoon in Bali, or a corporate retreat in Dubai.</p>',
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'content' => '<h2>Our Services</h2>
<p>UniWorld Holidays offers comprehensive travel solutions to make your journey seamless from start to finish.</p>

<h3>🧳 Holiday Packages</h3>
<p>Carefully designed domestic and international packages for families, couples, friends, and solo travellers. From budget-friendly to luxury — we have options for every style.</p>

<h3>🏨 Hotel Booking</h3>
<p>Access to 10,000+ hotels worldwide. We match your budget and preferences to find the perfect stay — from heritage havelis to beachfront resorts.</p>

<h3>✈️ Flight Booking</h3>
<p>Competitive airfares with flexible booking options. We compare multiple airlines to find the best routes and prices for your travel dates.</p>

<h3>📋 Visa Assistance</h3>
<p>Complete visa documentation support including form filling, document checklist, appointment booking, and application tracking for all major countries.</p>

<h3>🚗 Transfers & Transport</h3>
<p>Airport pickups, intercity transfers, self-drive rentals, and chauffeur-driven cars arranged at all destinations.</p>

<h3>🛡️ Travel Insurance</h3>
<p>Comprehensive travel insurance covering medical emergencies, trip cancellation, baggage loss, and flight delays.</p>

<h3>🏢 Corporate Travel & MICE</h3>
<p>End-to-end corporate travel management including conferences, team outings, incentive trips, and business travel.</p>

<h3>💱 Forex Services</h3>
<p>Foreign exchange at competitive rates. Currency cards, cash exchange, and wire transfer services available.</p>',
            ],
            [
                'title' => 'Gallery',
                'slug' => 'gallery',
                'content' => '<h2>Travel Gallery</h2>
<p>A glimpse of the experiences our travellers have enjoyed across destinations.</p>

<div class="row g-3 mt-4">
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-mountain fa-3x text-primary mb-3"></i><p>Kashmir Valley</p></div></div>
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-umbrella-beach fa-3x text-primary mb-3"></i><p>Goa Beaches</p></div></div>
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-city fa-3x text-primary mb-3"></i><p>Dubai Skyline</p></div></div>
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-water fa-3x text-primary mb-3"></i><p>Kerala Backwaters</p></div></div>
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-gopuram fa-3x text-primary mb-3"></i><p>Rajasthan Forts</p></div></div>
<div class="col-md-4"><div class="p-4 bg-light rounded text-center"><i class="fa-solid fa-tree-palm fa-3x text-primary mb-3"></i><p>Bali Temples</p></div></div>
</div>

<p class="mt-4">Want to see more? Follow us on <a href="#">Instagram</a> for daily travel inspiration.</p>',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2>
<p><strong>Last updated:</strong> June 2026</p>

<h3>1. Information We Collect</h3>
<p>We collect personal information that you provide directly to us, including:</p>
<ul>
<li>Name, email address, phone number</li>
<li>Travel preferences and dates</li>
<li>Payment information (processed securely via third-party gateways)</li>
<li>Communication records (enquiries, messages)</li>
</ul>

<h3>2. How We Use Your Information</h3>
<ul>
<li>To process and manage your travel bookings</li>
<li>To communicate with you about your trips</li>
<li>To send relevant offers and updates (with your consent)</li>
<li>To improve our services</li>
</ul>

<h3>3. Data Security</h3>
<p>We implement appropriate security measures to protect your personal information. Payment data is processed through secure, PCI-compliant payment processors.</p>

<h3>4. Third-Party Sharing</h3>
<p>We share your information only with hotels, airlines, and service providers necessary to fulfil your bookings. We do not sell your data to third parties.</p>

<h3>5. Your Rights</h3>
<p>You have the right to access, correct, or delete your personal information. Contact us at hello@uniworldholidays.com for any data-related requests.</p>

<h3>6. Contact Us</h3>
<p>For privacy-related queries, please contact:<br>Email: hello@uniworldholidays.com<br>Phone: +91 98765 43210</p>',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'content' => '<h2>Terms & Conditions</h2>
<p><strong>Last updated:</strong> June 2026</p>

<h3>1. Booking & Payment</h3>
<ul>
<li>A minimum 30% advance payment is required to confirm any booking.</li>
<li>Full payment must be completed 15 days before the travel date.</li>
<li>Prices are subject to change based on availability and season.</li>
</ul>

<h3>2. Cancellation Policy</h3>
<ul>
<li>30+ days before travel: 10% cancellation charge</li>
<li>15-30 days before travel: 25% cancellation charge</li>
<li>7-15 days before travel: 50% cancellation charge</li>
<li>Less than 7 days: 75% cancellation charge</li>
<li>No-show: 100% charge (no refund)</li>
</ul>

<h3>3. Amendments</h3>
<p>Changes to itinerary, dates, or hotels are subject to availability and may incur additional charges. Requests must be made at least 7 days before travel.</p>

<h3>4. Travel Documents</h3>
<p>It is the traveller\'s responsibility to ensure valid passports, visas, and health documents. UniWorld Holidays is not liable for denied boarding or entry due to documentation issues.</p>

<h3>5. Liability</h3>
<p>UniWorld Holidays acts as an intermediary between travellers and service providers (hotels, airlines, transport). We are not liable for delays, cancellations, or service quality issues caused by third-party providers.</p>

<h3>6. Force Majeure</h3>
<p>We are not responsible for trip disruptions caused by natural disasters, political unrest, pandemics, or other events beyond our control.</p>

<h3>7. Disputes</h3>
<p>All disputes shall be subject to the jurisdiction of courts in Ahmedabad, Gujarat, India.</p>

<h3>8. Contact</h3>
<p>For queries regarding these terms, contact us at hello@uniworldholidays.com or +91 98765 43210.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['is_published' => true, 'published_at' => now()])
            );
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            ['question' => 'How do I book a holiday package?', 'answer' => '<p>You can enquire through our website contact form, WhatsApp, or call us directly. Our team will understand your requirements and prepare a customised quotation within 24 hours.</p>', 'category' => 'booking'],
            ['question' => 'What is your cancellation policy?', 'answer' => '<p>Cancellation charges depend on how close to the travel date you cancel. Generally: 30+ days = 10% charge, 15-30 days = 25%, 7-15 days = 50%, less than 7 days = 75%. No-show = 100%.</p>', 'category' => 'cancellation'],
            ['question' => 'Do you provide visa assistance?', 'answer' => '<p>Yes, we provide complete visa documentation support including form filling, document checklist, appointment booking, and application tracking for all major countries.</p>', 'category' => 'visa'],
            ['question' => 'What payment methods do you accept?', 'answer' => '<p>We accept bank transfers (NEFT/RTGS), UPI, credit cards, debit cards, cheques, and cash. EMI options available on select credit cards.</p>', 'category' => 'booking'],
            ['question' => 'Is travel insurance included?', 'answer' => '<p>Travel insurance is not included by default but we strongly recommend it. We can arrange comprehensive travel insurance at competitive rates as an add-on.</p>', 'category' => 'travel'],
            ['question' => 'Can I customise a package?', 'answer' => '<p>Absolutely! All our packages are fully customisable. Tell us your preferences — hotels, activities, duration, budget — and we will tailor it to your needs.</p>', 'category' => 'packages'],
            ['question' => 'What if I need help during my trip?', 'answer' => '<p>We provide 24/7 trip assistance. You will have a dedicated coordinator\'s number throughout your journey for any issues or changes needed.</p>', 'category' => 'travel'],
            ['question' => 'Do you offer group discounts?', 'answer' => '<p>Yes, we offer special rates for groups of 10 or more. Corporate groups, family reunions, and friend circles all qualify for group discounts.</p>', 'category' => 'packages'],
        ];

        foreach ($faqs as $i => $faq) {
            Faq::create(array_merge($faq, ['is_active' => true, 'sort_order' => $i]));
        }
    }

    private function seedStaffUsers(): void
    {
        $staff = [
            ['name' => 'Ravi Sales', 'email' => 'ravi@uniworldholidays.com', 'role' => 'sales'],
            ['name' => 'Meena Ops', 'email' => 'meena@uniworldholidays.com', 'role' => 'operations'],
            ['name' => 'Priya Content', 'email' => 'priya@uniworldholidays.com', 'role' => 'content'],
        ];

        foreach ($staff as $user) {
            $created = User::firstOrCreate(
                ['email' => $user['email']],
                ['name' => $user['name'], 'password' => Hash::make('password'), 'email_verified_at' => now()]
            );
            if (!$created->hasRole($user['role'])) {
                $created->assignRole($user['role']);
            }
        }
    }

    private function seedSettings(): void
    {
        $settings = [
            'company_name' => 'UniWorld Holidays',
            'company_tagline' => 'Your Journey, Our Passion',
            'company_phone' => '+91 98765 43210',
            'company_whatsapp' => '919876543210',
            'company_email' => 'hello@uniworldholidays.com',
            'company_address' => 'A-101, Business Hub, SG Highway',
            'company_city' => 'Ahmedabad, Gujarat, India',
            'social_facebook' => 'https://www.facebook.com/uniworldholidays',
            'social_instagram' => 'https://www.instagram.com/uniworldholidays',
            'social_youtube' => 'https://www.youtube.com/@uniworldholidays',
            'quotation_default_terms' => "1. 30% advance required to confirm booking.\n2. Full payment due 15 days before travel.\n3. Cancellation charges apply as per policy.\n4. Prices subject to availability.\n5. Government taxes extra where applicable.",
            'quotation_validity_days' => '7',
            'razorpay_enabled' => 'false',
            'razorpay_mode' => 'test',
            'razorpay_key_id' => '',
            'razorpay_key_secret' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => explode('_', $key)[0], 'label' => str($key)->replace('_', ' ')->title()]
            );
        }
    }
}
