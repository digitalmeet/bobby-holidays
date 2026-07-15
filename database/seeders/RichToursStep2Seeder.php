<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class RichToursStep2Seeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🏔️  Updating Kashmir & Goa tours...');
        $this->kashmir1();
        $this->kashmir2();
        $this->goa1();
        $this->command->info('✅ Step 2 complete — Kashmir & Goa tours updated.');
    }

    private function kashmir1(): void
    {
        Tour::where('title', 'Kashmir Delight')->update([
            'subtitle'         => 'Srinagar · Gulmarg · Pahalgam — 5 Nights Family Package',
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Kashmir Delight Family Package — 5N/6D Srinagar Gulmarg Pahalgam',
            'meta_description' => 'Best Kashmir family tour. Houseboat stay, Gulmarg gondola, Pahalgam valley, Mughal gardens. Starting ₹24,999 per person.',
            'overview'         => '<p>The <strong>Kashmir Delight</strong> package is our most popular family holiday — a perfectly paced 5-night journey through the three jewels of the Kashmir Valley: <strong>Srinagar</strong>, <strong>Gulmarg</strong>, and <strong>Pahalgam</strong>.</p><p>You will begin with the magic of <em>Dal Lake</em> — a Shikara ride at sunrise, a stroll through the floating vegetable markets, and an evening on a traditional houseboat. Srinagar\'s Mughal Gardens — Shalimar Bagh, Nishat Bagh, and Chashme Shahi — are among the most beautiful formal gardens in Asia.</p><p>The excursion to <strong>Gulmarg</strong> is the highlight for most families — the Gondola ride (Asia\'s highest cable car) lifts you to 3,980 metres above sea level, where snow-capped peaks stretch in every direction. In winter, Gulmarg is a world-class ski resort; in summer, a vast green meadow carpeted with wildflowers.</p><p><strong>Pahalgam</strong> — the Valley of Shepherds — sits at the confluence of the Lidder River and the Sheshnag stream. Betaab Valley, Aru Valley, and Chandanwari are scenic drives that leave every visitor speechless.</p>',
            'highlights'       => json_encode([
                ['text' => 'Sunrise Shikara ride on Dal Lake with floating market visit'],
                ['text' => 'Overnight stay in a traditional Kashmiri houseboat'],
                ['text' => 'Gulmarg Gondola — Asia\'s highest cable car at 3,980m'],
                ['text' => 'Mughal Gardens: Shalimar Bagh, Nishat Bagh & Chashme Shahi'],
                ['text' => 'Scenic drive through Pahalgam and Betaab Valley'],
                ['text' => 'Aru Valley and Chandanwari excursion from Pahalgam'],
                ['text' => 'Authentic Kashmiri Wazwan dinner experience'],
                ['text' => 'Shopping for Pashmina shawls and saffron at local markets'],
            ]),
            'inclusions'       => json_encode([
                ['text' => '5 nights accommodation (3N Srinagar hotel + 1N houseboat + 1N Pahalgam hotel)'],
                ['text' => 'Daily breakfast and dinner (MAP basis)'],
                ['text' => 'Airport/railway station transfers on arrival and departure'],
                ['text' => 'All sightseeing by private non-AC Sumo/Innova'],
                ['text' => 'Shikara ride on Dal Lake (1 hour)'],
                ['text' => 'Gulmarg Gondola Phase 1 ticket (Gulmarg to Kongdori)'],
                ['text' => 'Pahalgam local sightseeing — Betaab Valley, Aru Valley'],
                ['text' => 'All toll taxes, parking, and driver allowances'],
            ]),
            'exclusions'       => json_encode([
                ['text' => 'Airfare / train tickets to and from Srinagar'],
                ['text' => 'Gulmarg Gondola Phase 2 ticket (Kongdori to Apharwat Peak)'],
                ['text' => 'Lunch at restaurants'],
                ['text' => 'Personal expenses — laundry, tips, shopping'],
                ['text' => 'Adventure activities — skiing, snowboarding, horse riding'],
                ['text' => 'Travel insurance'],
                ['text' => 'GST (5%) on total package cost'],
            ]),
            'itinerary'        => json_encode([
                [
                    'day'           => 1,
                    'title'         => 'Arrival in Srinagar — Dal Lake & Houseboat Check-in',
                    'description'   => 'Arrive at Srinagar Airport. Met by our representative and transferred to your houseboat on Dal Lake. Enjoy a leisurely Shikara ride on the lake, gliding past floating gardens. Watch the sunset over the Zabarwan mountains. Welcome dinner on the houseboat.',
                    'meals'         => 'Dinner',
                    'accommodation' => 'Traditional Houseboat, Dal Lake',
                ],
                [
                    'day'           => 2,
                    'title'         => 'Srinagar Sightseeing — Mughal Gardens & Old City',
                    'description'   => 'Early morning Shikara ride to the floating vegetable market. After breakfast, visit Shalimar Bagh, Nishat Bagh, and Chashme Shahi. Afternoon visit to Shankaracharya Temple for panoramic views of Srinagar. Evening stroll on the Boulevard Road.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Srinagar',
                ],
                [
                    'day'           => 3,
                    'title'         => 'Gulmarg Excursion — Asia\'s Highest Gondola',
                    'description'   => 'After breakfast, drive to Gulmarg (56 km, approx. 2 hours). Board the Gondola Phase 1 to Kongdori at 3,050m — breathtaking views of the Himalayan peaks. Optional Phase 2 to Apharwat Peak at 3,980m (payable extra). Enjoy snow activities in winter or meadow walks in summer. Return to Srinagar by evening.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Srinagar',
                ],
                [
                    'day'           => 4,
                    'title'         => 'Pahalgam — Valley of Shepherds',
                    'description'   => 'After breakfast, drive to Pahalgam (96 km, approx. 3 hours) through saffron fields and apple orchards. Check in to your hotel. Afternoon excursion to Betaab Valley — a lush green valley surrounded by dense pine forests and snow-capped peaks. Evening walk along the Lidder River.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Pahalgam',
                ],
                [
                    'day'           => 5,
                    'title'         => 'Aru Valley & Chandanwari — Pahalgam Exploration',
                    'description'   => 'Full day exploring Pahalgam. Morning visit to Aru Valley — a serene meadow and base camp for treks to Kolahoi Glacier. Afternoon at Chandanwari — starting point of the Amarnath Yatra, with a natural snow bridge. Evening at leisure in Pahalgam bazaar.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Pahalgam',
                ],
                [
                    'day'           => 6,
                    'title'         => 'Return to Srinagar — Departure',
                    'description'   => 'After breakfast, drive back to Srinagar. En route, stop at the Awantipora ruins — 9th-century Hindu temples on the banks of the Jhelum River. Time for last-minute shopping at Lal Chowk — Kashmiri dry fruits, saffron, and Pashmina shawls. Transfer to Srinagar Airport.',
                    'meals'         => 'Breakfast',
                    'accommodation' => '',
                ],
            ]),
        ]);
        $this->command->line('  → Kashmir Delight: ✅ updated');
    }

    private function kashmir2(): void
    {
        Tour::where('title', 'Kashmir Honeymoon Special')->update([
            'subtitle'         => 'Srinagar · Gulmarg · Pahalgam — 4 Nights Romantic Escape',
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 2,
            'meta_title'       => 'Kashmir Honeymoon Package — 4N/5D Romantic Srinagar Gulmarg Tour',
            'meta_description' => 'Romantic Kashmir honeymoon with houseboat stay, Gulmarg gondola, candlelight dinners, and couple activities. Starting ₹32,999 per person.',
            'overview'         => '<p>The <strong>Kashmir Honeymoon Special</strong> is crafted exclusively for couples — a romantic 4-night journey through the most beautiful corners of the Kashmir Valley, with special honeymoon touches at every step.</p><p>Your journey begins on the iconic <em>Dal Lake</em>, where you will be welcomed aboard a premium houseboat decorated with fresh flowers. A private Shikara ride at sunset, a candlelight dinner on the lake, and the sound of gentle waves — this is Kashmir romance at its finest.</p><p>The Gulmarg excursion takes you to the <strong>roof of Kashmir</strong> — the Gondola ride to Kongdori offers panoramic views of Nanga Parbat and the Himalayan ranges. In winter, the snow-covered meadows are among the most romantic landscapes in India.</p><p>Pahalgam provides the perfect finale — a quiet valley town where the Lidder River rushes past pine forests. A private riverside picnic, a pony ride through the meadows, and a final evening watching the stars complete this unforgettable honeymoon.</p>',
            'highlights'       => json_encode([
                ['text' => 'Premium houseboat stay with honeymoon decoration on Dal Lake'],
                ['text' => 'Private candlelight dinner on the houseboat deck'],
                ['text' => 'Romantic sunset Shikara ride on Dal Lake'],
                ['text' => 'Gulmarg Gondola — snow-capped peaks and alpine meadows'],
                ['text' => 'Private riverside picnic in Pahalgam'],
                ['text' => 'Betaab Valley and Aru Valley scenic drives'],
                ['text' => 'Couple\'s Kashmiri Wazwan dinner experience'],
                ['text' => 'Complimentary honeymoon cake and room decoration'],
            ]),
            'inclusions'       => json_encode([
                ['text' => '4 nights accommodation (2N premium houseboat + 1N Srinagar hotel + 1N Pahalgam hotel)'],
                ['text' => 'Daily breakfast and dinner'],
                ['text' => 'Honeymoon decoration on houseboat (flowers, candles, petals)'],
                ['text' => 'Complimentary honeymoon cake'],
                ['text' => 'Private candlelight dinner on houseboat (1 evening)'],
                ['text' => 'All airport/station transfers by private cab'],
                ['text' => 'All sightseeing by private vehicle'],
                ['text' => 'Shikara ride on Dal Lake (1 hour)'],
                ['text' => 'Gulmarg Gondola Phase 1 ticket'],
            ]),
            'exclusions'       => json_encode([
                ['text' => 'Airfare / train tickets to and from Srinagar'],
                ['text' => 'Gulmarg Gondola Phase 2 ticket (payable on site)'],
                ['text' => 'Lunch at restaurants'],
                ['text' => 'Personal expenses and shopping'],
                ['text' => 'Adventure activities (skiing, horse riding)'],
                ['text' => 'Travel insurance'],
                ['text' => 'GST (5%) on total package cost'],
            ]),
            'itinerary'        => json_encode([
                [
                    'day'           => 1,
                    'title'         => 'Arrival — Houseboat Welcome & Sunset Shikara',
                    'description'   => 'Arrive at Srinagar Airport. Transferred to your premium houseboat on Dal Lake, decorated with fresh flowers and rose petals. Enjoy a private Shikara ride at sunset — the golden light on the Himalayan peaks and the still waters of Dal Lake create a magical atmosphere. Candlelight dinner on the houseboat deck.',
                    'meals'         => 'Dinner',
                    'accommodation' => 'Premium Houseboat, Dal Lake',
                ],
                [
                    'day'           => 2,
                    'title'         => 'Srinagar — Mughal Gardens & Old City Romance',
                    'description'   => 'Morning Shikara ride to the floating flower market. After breakfast, visit Shalimar Bagh and Nishat Bagh — the most romantic of the Mughal Gardens, with terraced lawns, fountains, and mountain backdrops. Afternoon at Shankaracharya Temple. Evening stroll along the Boulevard watching the lights of Srinagar reflect on Dal Lake.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Srinagar',
                ],
                [
                    'day'           => 3,
                    'title'         => 'Gulmarg — Snow, Meadows & Mountain Views',
                    'description'   => 'Drive to Gulmarg through pine forests and mountain villages. Board the Gondola to Kongdori — views of Nanga Parbat (8,126m) are awe-inspiring. Enjoy the snow or wildflower meadows together. Optional horse ride through the meadows. Return to Srinagar for a relaxed evening.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Srinagar',
                ],
                [
                    'day'           => 4,
                    'title'         => 'Pahalgam — Valley of Shepherds & Riverside Picnic',
                    'description'   => 'Drive to Pahalgam through the saffron fields of Pampore. Check in to your hotel overlooking the Lidder River. Afternoon private picnic by the riverside with local snacks and Kahwa tea. Visit Betaab Valley for a romantic walk through the pine forests. Evening at leisure in Pahalgam.',
                    'meals'         => 'Breakfast, Dinner',
                    'accommodation' => 'Hotel in Pahalgam',
                ],
                [
                    'day'           => 5,
                    'title'         => 'Departure — Last Memories of Kashmir',
                    'description'   => 'After a leisurely breakfast, drive back to Srinagar. Stop at the Pampore saffron fields (seasonal) and Awantipora ruins en route. Last-minute shopping at Lal Chowk — Kashmiri saffron, dry fruits, and Pashmina shawls. Transfer to Srinagar Airport.',
                    'meals'         => 'Breakfast',
                    'accommodation' => '',
                ],
            ]),
        ]);
        $this->command->line('  → Kashmir Honeymoon Special: ✅ updated');
    }

    private function goa1(): void
    {
        Tour::where('title', 'Goa Beach Carnival')->update([
            'subtitle'         => 'North Goa · South Goa · Old Goa — 3 Nights Beach & Heritage',
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 15,
            'meta_title'       => 'Goa Beach Package — 3N/4D North & South Goa Tour',
            'meta_description' => 'Best Goa holiday package with beach stays, water sports, heritage tours, sunset cruise, and Dudhsagar falls. Starting ₹15,999 per person.',
            'overview'         => '<p>The <strong>Goa Beach Carnival</strong> is the perfect introduction to India\'s most vibrant coastal destination — a 3-night package covering the best of <strong>North Goa</strong>, <strong>South Goa</strong>, and <strong>Old Goa\'s</strong> Portuguese heritage.</p><p>North Goa is where the energy is — <em>Baga</em> and <em>Calangute</em> beaches buzz with water sports, beach shacks, and sunset parties. Parasailing over the Arabian Sea, jet skiing through the waves, and a banana boat ride are experiences that define the Goa holiday. The famous <strong>Anjuna Flea Market</strong> and the <strong>Arpora Saturday Night Bazaar</strong> are shopping experiences unlike any other in India.</p><p>Old Goa is a UNESCO World Heritage treasure — the <em>Basilica of Bom Jesus</em> houses the mortal remains of St. Francis Xavier, while the <em>Se Cathedral</em> is the largest church in Asia. The Portuguese colonial architecture and the cobblestone streets of <strong>Fontainhas</strong> transport you to another era.</p><p>The Dudhsagar Waterfalls jeep safari is the adventure highlight — a thrilling off-road drive through the Bhagwan Mahavir Wildlife Sanctuary to reach one of India\'s tallest waterfalls (310 metres).</p>',
            'highlights'       => json_encode([
                ['text' => 'Water sports at Baga Beach — parasailing, jet ski, banana boat'],
                ['text' => 'Sunset cruise on the Mandovi River with live Goan music'],
                ['text' => 'Basilica of Bom Jesus & Se Cathedral — UNESCO World Heritage'],
                ['text' => 'Dudhsagar Waterfalls jeep safari and swimming'],
                ['text' => 'Anjuna Flea Market or Arpora Saturday Night Bazaar'],
                ['text' => 'Fontainhas Latin Quarter heritage walk in Panaji'],
                ['text' => 'South Goa beach day — Palolem or Agonda'],
                ['text' => 'Fresh seafood dinner at a beachside shack'],
            ]),
            'inclusions'       => json_encode([
                ['text' => '3 nights accommodation in a beach resort/hotel in North Goa'],
                ['text' => 'Daily breakfast'],
                ['text' => 'Airport/railway station transfers on arrival and departure'],
                ['text' => 'North Goa sightseeing by private cab (Old Goa, Panaji, Calangute, Baga, Anjuna)'],
                ['text' => 'South Goa sightseeing by private cab (Palolem, Colva, Margao)'],
                ['text' => 'Sunset cruise on Mandovi River (shared)'],
                ['text' => 'Dudhsagar Waterfalls jeep safari (shared jeep)'],
                ['text' => 'All toll taxes, parking, and driver allowances'],
            ]),
            'exclusions'       => json_encode([
                ['text' => 'Airfare / train tickets to and from Goa'],
                ['text' => 'Lunch and dinner (except breakfast)'],
                ['text' => 'Water sports activities (payable on site — approx. ₹1,500–3,000 per person)'],
                ['text' => 'Entry fees to churches, museums, and attractions'],
                ['text' => 'Personal expenses — shopping, tips, alcohol'],
                ['text' => 'Travel insurance'],
                ['text' => 'GST (5%) on total package cost'],
            ]),
            'itinerary'        => json_encode([
                [
                    'day'           => 1,
                    'title'         => 'Arrival in Goa — Beach Check-in & Sunset Cruise',
                    'description'   => 'Arrive at Goa Airport. Transferred to your beach hotel in North Goa. After freshening up, head to Calangute or Baga Beach for your first taste of the Goan coast. Evening: board the Mandovi River sunset cruise — live Goan folk music and the Panaji skyline at dusk. Dinner at a beachside shack on your own.',
                    'meals'         => 'Breakfast',
                    'accommodation' => 'Beach Resort, North Goa',
                ],
                [
                    'day'           => 2,
                    'title'         => 'North Goa — Water Sports, Heritage & Markets',
                    'description'   => 'Morning at Baga or Calangute Beach for water sports — parasailing, jet skiing, and banana boat rides. Afternoon: heritage tour of Old Goa — Basilica of Bom Jesus, Se Cathedral, and Church of St. Francis of Assisi. Evening: Fontainhas Latin Quarter walk in Panaji. Night: Anjuna Flea Market (Wed) or Arpora Saturday Night Bazaar.',
                    'meals'         => 'Breakfast',
                    'accommodation' => 'Beach Resort, North Goa',
                ],
                [
                    'day'           => 3,
                    'title'         => 'Dudhsagar Falls & South Goa Beaches',
                    'description'   => 'Early morning departure for the Dudhsagar Waterfalls jeep safari — a thrilling 45-minute off-road drive through the jungle to reach the 310-metre waterfall. Swim in the natural pool at the base. Afternoon: drive to South Goa — visit the pristine beaches of Palolem or Agonda. Sunset at Palolem Beach. Seafood dinner at a South Goa beach shack.',
                    'meals'         => 'Breakfast',
                    'accommodation' => 'Beach Resort, North Goa',
                ],
                [
                    'day'           => 4,
                    'title'         => 'Departure — Last Morning in Goa',
                    'description'   => 'After breakfast, free time for last-minute shopping at the Mapusa Market or Calangute Market — Goan cashews, spices, feni, and beach souvenirs. Transfer to Goa Airport for your onward journey.',
                    'meals'         => 'Breakfast',
                    'accommodation' => '',
                ],
            ]),
        ]);
        $this->command->line('  → Goa Beach Carnival: ✅ updated');
    }
}
