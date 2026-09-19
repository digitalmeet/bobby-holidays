<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\FollowUp;
use App\Models\OnlinePayment;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LogicException;
use Spatie\Permission\Models\Role;

class ClientDemoSeeder extends Seeder
{
    private const IMAGE_ROOT = 'assets/frontend/images/demo/';

    public function run(): void
    {
        if (app()->environment('production') && !config('demo.allow_seed')) {
            throw new LogicException('Demo seeding is disabled in production. Set ALLOW_DEMO_SEEDING=true only for an intentional demo environment.');
        }

        if (Role::query()->whereIn('name', ['super_admin', 'sales', 'operations', 'content'])->count() < 4) {
            $this->call(RolesAndPermissionsSeeder::class);
        }

        DB::transaction(function (): void {
            $users = $this->seedUsers();
            [$destinations, $tours] = $this->seedCatalogue();
            $this->seedCms($users['content'], $tours);
            $this->seedSalesPipeline($users, $destinations, $tours);
            $this->seedSettings();
        }, 3);

        $this->call(PremiumWebsiteContentSeeder::class);

        $this->command?->info('Client-ready demo data seeded. Login password for demo users: Demo@12345');
    }

    private function seedUsers(): array
    {
        $definitions = [
            'super_admin' => ['name' => 'Aditi Kapoor', 'email' => 'demo.admin@uniworld.test'],
            'sales' => ['name' => 'Rohan Desai', 'email' => 'demo.sales@uniworld.test'],
            'operations' => ['name' => 'Meera Nair', 'email' => 'demo.operations@uniworld.test'],
            'content' => ['name' => 'Kabir Shah', 'email' => 'demo.content@uniworld.test'],
        ];

        $users = [];
        foreach ($definitions as $role => $definition) {
            $user = User::updateOrCreate(
                ['email' => $definition['email']],
                [
                    'name' => $definition['name'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('Demo@12345'),
                ],
            );
            $user->syncRoles([$role]);
            $users[$role] = $user;
        }

        return $users;
    }

    private function seedCatalogue(): array
    {
        $definitions = [
            'kashmir' => ['name' => 'Kashmir', 'country' => 'India', 'continent' => 'Domestic', 'image' => 'destination-kashmir.webp', 'title' => 'Kashmir Valley Retreat', 'category' => 'family', 'days' => 6, 'price' => 34900],
            'goa' => ['name' => 'Goa', 'country' => 'India', 'continent' => 'Domestic', 'image' => 'destination-goa.webp', 'title' => 'Goa Coastal Escape', 'category' => 'leisure', 'days' => 4, 'price' => 18900],
            'kerala' => ['name' => 'Kerala', 'country' => 'India', 'continent' => 'Domestic', 'image' => 'destination-kerala.webp', 'title' => 'Kerala Backwater Journey', 'category' => 'family', 'days' => 6, 'price' => 32900],
            'rajasthan' => ['name' => 'Rajasthan', 'country' => 'India', 'continent' => 'Domestic', 'image' => 'destination-rajasthan.webp', 'title' => 'Royal Rajasthan Circuit', 'category' => 'cultural', 'days' => 8, 'price' => 48900],
            'dubai' => ['name' => 'Dubai', 'country' => 'United Arab Emirates', 'continent' => 'Middle East', 'image' => 'destination-dubai.webp', 'title' => 'Dubai Signature Experience', 'category' => 'luxury', 'days' => 5, 'price' => 74900],
            'bali' => ['name' => 'Bali', 'country' => 'Indonesia', 'continent' => 'Asia', 'image' => 'destination-bali.webp', 'title' => 'Romantic Bali Hideaway', 'category' => 'honeymoon', 'days' => 6, 'price' => 82900],
            'maldives' => ['name' => 'Maldives', 'country' => 'Maldives', 'continent' => 'Asia', 'image' => 'destination-maldives.webp', 'title' => 'Maldives Overwater Luxury', 'category' => 'luxury', 'days' => 5, 'price' => 154900],
        ];

        $destinations = [];
        $tours = [];

        foreach ($definitions as $slug => $definition) {
            $image = self::IMAGE_ROOT . $definition['image'];
            $destination = Destination::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $definition['name'],
                    'country' => $definition['country'],
                    'continent' => $definition['continent'],
                    'short_description' => "A carefully curated {$definition['name']} holiday with authentic experiences and dependable local support.",
                    'description' => "<p>Discover <strong>{$definition['name']}</strong> through a balanced itinerary of signature sights, local culture and unhurried experiences. Every detail is planned for comfort, clarity and memorable travel.</p>",
                    'highlights' => [
                        ['highlight' => 'Handpicked stays in convenient locations'],
                        ['highlight' => 'Private transfers and guided sightseeing'],
                        ['highlight' => 'Local experiences with time to explore'],
                    ],
                    'hero_image' => $image,
                    'og_image' => $image,
                    'gallery' => [$image],
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => count($destinations),
                ],
            );

            $tourSlug = str($definition['title'])->slug()->toString();
            $tour = Tour::updateOrCreate(
                ['slug' => $tourSlug],
                [
                    'destination_id' => $destination->id,
                    'title' => $definition['title'],
                    'subtitle' => "{$definition['days']} days of signature {$definition['name']} experiences",
                    'duration_days' => $definition['days'],
                    'duration_nights' => $definition['days'] - 1,
                    'overview' => '<p>A client-ready itinerary combining comfortable stays, private transfers, key attractions and carefully paced free time.</p>',
                    'highlights' => [['text' => 'Private arrival transfer'], ['text' => 'Daily breakfast'], ['text' => 'Curated sightseeing'], ['text' => '24/7 trip support']],
                    'inclusions' => [['text' => 'Accommodation'], ['text' => 'Breakfast'], ['text' => 'Transfers'], ['text' => 'Sightseeing']],
                    'exclusions' => [['text' => 'Flights unless specified'], ['text' => 'Personal expenses'], ['text' => 'Travel insurance']],
                    'itinerary' => collect(range(1, $definition['days']))->map(fn (int $day) => [
                        'day' => $day,
                        'title' => $day === 1 ? 'Arrival and welcome' : ($day === $definition['days'] ? 'Departure' : "Curated experience day {$day}"),
                        'description' => $day === 1 ? 'Private transfer and relaxed check-in.' : 'Guided highlights with flexible leisure time.',
                        'meals' => 'Breakfast',
                        'accommodation' => $day < $definition['days'] ? 'Handpicked hotel' : '',
                    ])->all(),
                    'hero_image' => $image,
                    'og_image' => $image,
                    'gallery' => [$image],
                    'starting_price' => $definition['price'],
                    'price_type' => 'per_person',
                    'min_group_size' => 2,
                    'max_group_size' => 12,
                    'difficulty_level' => 'easy',
                    'category' => $definition['category'],
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => count($tours),
                    'published_at' => now()->subMonth(),
                ],
            );

            foreach ([
                ['label' => 'Comfort', 'multiplier' => 1],
                ['label' => 'Premium', 'multiplier' => 1.35],
            ] as $index => $tier) {
                TourPricing::updateOrCreate(
                    ['tour_id' => $tour->id, 'label' => $tier['label']],
                    [
                        'price_per_person' => round($definition['price'] * $tier['multiplier']),
                        'child_price' => round($definition['price'] * $tier['multiplier'] * .7),
                        'infant_price' => 0,
                        'currency' => 'INR',
                        'valid_from' => now()->startOfYear(),
                        'valid_until' => now()->addYear()->endOfYear(),
                        'is_active' => true,
                        'sort_order' => $index,
                    ],
                );
            }

            $destinations[$slug] = $destination;
            $tours[$slug] = $tour;
        }

        return [$destinations, $tours];
    }

    private function seedSalesPipeline(array $users, array $destinations, array $tours): void
    {
        $leads = [
            ['name' => 'Arjun & Nisha Mehta', 'email' => 'arjun.mehta@demo.test', 'phone' => '+91 98250 11001', 'place' => 'kashmir', 'status' => 'accepted', 'amount' => 87250, 'booking' => 'partial_paid'],
            ['name' => 'The Shah Family', 'email' => 'shah.family@demo.test', 'phone' => '+91 98250 11002', 'place' => 'dubai', 'status' => 'accepted', 'amount' => 224700, 'booking' => 'confirmed'],
            ['name' => 'Riya and Dev Patel', 'email' => 'riya.patel@demo.test', 'phone' => '+91 98250 11003', 'place' => 'maldives', 'status' => 'accepted', 'amount' => 309800, 'booking' => 'fully_paid'],
            ['name' => 'Ananya Rao', 'email' => 'ananya.rao@demo.test', 'phone' => '+91 98250 11004', 'place' => 'bali', 'status' => 'sent', 'amount' => 165800, 'booking' => null],
            ['name' => 'Kunal Joshi', 'email' => 'kunal.joshi@demo.test', 'phone' => '+91 98250 11005', 'place' => 'rajasthan', 'status' => 'draft', 'amount' => 97800, 'booking' => null],
        ];

        foreach ($leads as $index => $lead) {
            $tour = $tours[$lead['place']];
            $destination = $destinations[$lead['place']];
            $enquiryStatus = $lead['booking'] ? 'converted' : ($lead['status'] === 'draft' ? 'contacted' : 'quoted');

            $enquiry = Enquiry::updateOrCreate(
                ['email' => $lead['email']],
                [
                    'tour_id' => $tour->id,
                    'destination_id' => $destination->id,
                    'name' => $lead['name'],
                    'phone' => $lead['phone'],
                    'country' => 'India',
                    'travel_date' => now()->addDays(35 + ($index * 12))->toDateString(),
                    'flexible_dates' => $index % 2 === 0,
                    'duration_days' => $tour->duration_days,
                    'adults' => 2,
                    'children' => $index === 1 ? 1 : 0,
                    'infants' => 0,
                    'budget_range' => '₹75,000 - ₹3,50,000',
                    'message' => "Interested in {$tour->title}; prefers comfortable hotels and private transfers.",
                    'status' => $enquiryStatus,
                    'source' => ['website', 'referral', 'instagram', 'whatsapp', 'walkin'][$index],
                    'assigned_to' => $users['sales']->id,
                    'last_contacted_at' => now()->subDays(max(1, 5 - $index)),
                    'follow_up_at' => $lead['booking'] ? null : now()->addDays($index + 1)->setHour(11),
                    'internal_notes' => 'Demo record: client priorities and next action are documented.',
                    'privacy_accepted_at' => now()->subDays(6 - $index),
                    'privacy_policy_version' => config('legal.privacy_policy_version'),
                    'consent_source' => 'demo-import',
                ],
            );

            FollowUp::updateOrCreate(
                ['enquiry_id' => $enquiry->id, 'notes' => 'Discovery call completed; preferences documented.'],
                [
                    'created_by' => $users['sales']->id,
                    'type' => 'call',
                    'status' => 'completed',
                    'scheduled_at' => now()->subDays(4),
                    'completed_at' => now()->subDays(4)->addMinutes(18),
                    'duration_seconds' => 1080,
                ],
            );

            if (!$lead['booking']) {
                FollowUp::updateOrCreate(
                    ['enquiry_id' => $enquiry->id, 'notes' => 'Review quotation and confirm travel dates.'],
                    [
                        'created_by' => $users['sales']->id,
                        'type' => 'whatsapp',
                        'status' => 'callback',
                        'scheduled_at' => now()->addDays($index + 1)->setHour(11),
                        'next_follow_up_at' => now()->addDays($index + 1)->setHour(11),
                    ],
                );
            }

            $quotation = Quotation::updateOrCreate(
                ['client_email' => $lead['email'], 'title' => $tour->title, 'version' => 1],
                [
                    'enquiry_id' => $enquiry->id,
                    'client_name' => $lead['name'],
                    'client_phone' => $lead['phone'],
                    'travel_date' => $enquiry->travel_date,
                    'return_date' => $enquiry->travel_date?->copy()->addDays($tour->duration_days - 1),
                    'adults' => 2,
                    'children' => $index === 1 ? 1 : 0,
                    'currency' => 'INR',
                    'subtotal_amount' => $lead['amount'],
                    'discount_amount' => 0,
                    'tax_amount' => 0,
                    'total_amount' => $lead['amount'],
                    'validity_date' => $lead['status'] === 'draft' ? now()->addDays(10) : now()->addDays(7),
                    'status' => $lead['status'],
                    'personalised_message' => "Dear {$lead['name']}, we have designed this journey around your preferences.",
                    'terms_and_conditions' => 'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',
                    'prepared_by' => $users['sales']->id,
                    'sent_at' => $lead['status'] !== 'draft' ? now()->subDays(2) : null,
                    'viewed_at' => $lead['status'] === 'accepted' ? now()->subDay() : null,
                    'view_count' => $lead['status'] === 'accepted' ? 2 : 0,
                    'accepted_at' => $lead['status'] === 'accepted' ? now()->subDay() : null,
                ],
            );

            $section = QuotationSection::updateOrCreate(
                ['quotation_id' => $quotation->id, 'title' => 'Package Summary'],
                ['description' => 'Core services included in the proposed holiday.', 'sort_order' => 1],
            );

            QuotationItem::updateOrCreate(
                ['quotation_id' => $quotation->id, 'title' => $tour->title],
                [
                    'section_id' => $section->id,
                    'sort_order' => 1,
                    'type' => 'package',
                    'description' => 'Accommodation, transfers and sightseeing as detailed in the itinerary.',
                    'nights' => $tour->duration_nights,
                    'unit_cost' => $lead['amount'],
                    'quantity' => 1,
                    'total_cost' => $lead['amount'],
                    'is_included_in_total' => true,
                    'is_optional' => false,
                ],
            );

            if (!$lead['booking']) {
                continue;
            }

            $paid = match ($lead['booking']) {
                'partial_paid' => 30000,
                'fully_paid' => $lead['amount'],
                default => 0,
            };

            $booking = Booking::updateOrCreate(
                ['quotation_id' => $quotation->id],
                [
                    'enquiry_id' => $enquiry->id,
                    'tour_id' => $tour->id,
                    'client_name' => $lead['name'],
                    'client_email' => $lead['email'],
                    'client_phone' => $lead['phone'],
                    'travel_date' => $enquiry->travel_date,
                    'return_date' => $enquiry->travel_date?->copy()->addDays($tour->duration_days - 1),
                    'adults' => 2,
                    'children' => $index === 1 ? 1 : 0,
                    'total_amount' => $lead['amount'],
                    'paid_amount' => $paid,
                    'balance_amount' => $lead['amount'] - $paid,
                    'currency' => 'INR',
                    'status' => $lead['booking'],
                    'assigned_to' => $users['operations']->id,
                    'special_requests' => 'Vegetarian breakfast and adjacent rooms where applicable.',
                ],
            );

            foreach ([
                ['first_name' => str($lead['name'])->before(' ')->toString(), 'last_name' => 'Traveller', 'type' => 'adult'],
                ['first_name' => 'Guest', 'last_name' => 'Traveller', 'type' => 'adult'],
            ] as $traveller) {
                Traveller::updateOrCreate(
                    ['booking_id' => $booking->id, 'first_name' => $traveller['first_name'], 'last_name' => $traveller['last_name']],
                    [
                        'type' => $traveller['type'],
                        'nationality' => 'Indian',
                        'date_of_birth' => now()->subYears(32)->subDays($index * 40)->toDateString(),
                        'notes' => 'Demo traveller; passport details intentionally omitted.',
                    ],
                );
            }

            if ($paid <= 0) {
                continue;
            }

            if ($lead['booking'] === 'fully_paid') {
                $online = OnlinePayment::updateOrCreate(
                    ['gateway' => 'razorpay', 'order_id' => "order_demo_{$booking->id}"],
                    [
                        'booking_id' => $booking->id,
                        'quotation_id' => $quotation->id,
                        'payment_id' => "pay_demo_{$booking->id}",
                        'amount' => $paid,
                        'currency' => 'INR',
                        'status' => 'captured',
                        'client_name' => $lead['name'],
                        'client_email' => $lead['email'],
                        'client_phone' => $lead['phone'],
                        'paid_at' => now()->subDay(),
                        'gateway_response' => ['demo' => true, 'status' => 'captured'],
                    ],
                );

                Payment::updateOrCreate(
                    ['online_payment_id' => $online->id],
                    [
                        'booking_id' => $booking->id,
                        'amount' => $paid,
                        'currency' => 'INR',
                        'method' => 'online',
                        'reference_number' => $online->payment_id,
                        'payment_date' => now()->subDay()->toDateString(),
                        'status' => 'received',
                        'notes' => 'Demo Razorpay payment',
                        'recorded_by' => $users['operations']->id,
                    ],
                );
            } else {
                Payment::updateOrCreate(
                    ['reference_number' => "DEMO-NEFT-{$booking->id}"],
                    [
                        'booking_id' => $booking->id,
                        'amount' => $paid,
                        'currency' => 'INR',
                        'method' => 'bank_transfer',
                        'payment_date' => now()->subDays(2)->toDateString(),
                        'status' => 'received',
                        'notes' => 'Demo advance received by bank transfer',
                        'recorded_by' => $users['operations']->id,
                    ],
                );
            }
        }
    }

    private function seedCms(User $author, array $tours): void
    {
        foreach ([
            ['slug' => 'about-us', 'title' => 'Travel Designed Around You', 'type' => 'page', 'content' => '<p>We plan thoughtful holidays with clear communication, trusted partners and support from enquiry to return.</p>'],
            ['slug' => 'visa-assistance', 'title' => 'Visa Assistance', 'type' => 'service', 'content' => '<p>Document guidance, appointment preparation and status coordination for supported destinations.</p>'],
            ['slug' => 'corporate-travel', 'title' => 'Corporate Travel', 'type' => 'service', 'content' => '<p>Responsive travel planning for teams, incentives, conferences and executive journeys.</p>'],
        ] as $index => $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page + [
                    'short_description' => str(strip_tags($page['content']))->limit(120),
                    'is_published' => true,
                    'published_at' => now()->subMonth(),
                    'sort_order' => $index,
                ],
            );
        }

        foreach ([
            ['slug' => 'best-time-to-visit-kashmir', 'title' => 'The Best Time to Visit Kashmir', 'category' => 'Destination Guide', 'image' => 'destination-kashmir.webp'],
            ['slug' => 'planning-a-maldives-honeymoon', 'title' => 'Planning a Memorable Maldives Honeymoon', 'category' => 'Honeymoon', 'image' => 'destination-maldives.webp'],
            ['slug' => 'dubai-family-holiday-guide', 'title' => 'A Practical Dubai Family Holiday Guide', 'category' => 'Family Travel', 'image' => 'destination-dubai.webp'],
        ] as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => 'Practical advice from planning and budgeting to experiences, timing and local travel.',
                    'content' => '<p>A successful holiday starts with realistic pacing, clear inclusions and time for spontaneous discoveries. This guide explains the choices that matter most.</p><h2>Plan with confidence</h2><p>Confirm travel dates, expected weather, entry requirements and cancellation terms before making non-refundable commitments.</p>',
                    'author_id' => $author->id,
                    'featured_image' => self::IMAGE_ROOT . $post['image'],
                    'category' => $post['category'],
                    'tags' => ['planning', 'travel tips', 'holidays'],
                    'is_published' => true,
                    'published_at' => now()->subDays(10),
                    'read_time_minutes' => 5,
                ],
            );
        }

        Banner::updateOrCreate(
            ['title' => 'Journeys Worth Remembering', 'position' => 'homepage_hero'],
            [
                'subtitle' => 'Personalised holidays, planned with care',
                'description' => 'Explore client-ready itineraries across India and beyond.',
                'cta_text' => 'Explore Packages',
                'cta_url' => '/domestic-packages',
                'image' => self::IMAGE_ROOT . 'destination-kashmir.webp',
                'mobile_image' => self::IMAGE_ROOT . 'destination-kashmir.webp',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        foreach ([
            ['name' => 'Mehta Family', 'location' => 'Ahmedabad', 'tour' => 'kashmir', 'content' => 'The pacing was perfect for our parents and children. Every transfer arrived on time and the houseboat stay was the highlight.'],
            ['name' => 'Riya & Dev', 'location' => 'Vadodara', 'tour' => 'maldives', 'content' => 'Clear advice, a beautiful resort selection and responsive support made our honeymoon completely stress-free.'],
            ['name' => 'Shah Family', 'location' => 'Surat', 'tour' => 'dubai', 'content' => 'The itinerary balanced attractions and free time exceptionally well. The kids are still talking about the desert evening.'],
        ] as $index => $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'tour_id' => $tours[$testimonial['tour']]->id],
                [
                    'location' => $testimonial['location'],
                    'rating' => 5,
                    'content' => $testimonial['content'],
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => $index,
                ],
            );
        }

        foreach ([
            ['question' => 'Can the itinerary be customised?', 'answer' => 'Yes. Hotels, sightseeing, pace, transfers and special experiences can be adjusted before confirmation.', 'category' => 'Planning'],
            ['question' => 'How much is required to confirm a booking?', 'answer' => 'The deposit depends on airline, hotel and supplier terms. Your quotation shows the exact schedule before you pay.', 'category' => 'Payments'],
            ['question' => 'Do you assist during the trip?', 'answer' => 'Yes. Confirmed clients receive an operations contact for urgent coordination throughout the journey.', 'category' => 'Support'],
        ] as $index => $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq + ['sort_order' => $index, 'is_active' => true],
            );
        }
    }

    private function seedSettings(): void
    {
        foreach ([
            'company_name' => 'UniWorld Holidays',
            'company_tagline' => 'Journeys worth remembering',
            'company_phone' => '+91 98765 43210',
            'company_whatsapp' => '+91 98765 43210',
            'company_email' => 'hello@uniworldholidays.test',
            'company_city' => 'Ahmedabad',
            'quotation_validity_days' => '7',
            'razorpay_enabled' => 'false',
        ] as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => str($key)->before('_')->toString(),
                    'label' => str($key)->replace('_', ' ')->title()->toString(),
                ],
            );
        }
    }
}
