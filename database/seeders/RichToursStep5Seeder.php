<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class RichToursStep5Seeder extends Seeder
{
    public function run(): void
    {
        // ── Romantic Bali ──────────────────────────────────────────────────
        Tour::where('title', 'Romantic Bali')->update([
            'subtitle'         => 'Island of the Gods — Love, Rice & Sunsets',
            'overview'         => "Bali has long cast a spell on lovers — a tropical island where ancient Hindu temples perch on clifftops above crashing surf, where terraced rice paddies glow emerald in the morning light, and where every sunset seems painted specifically for two. This 6-day romantic escape is crafted for couples who want the full Bali experience: spiritual, sensory, and deeply relaxing.\n\nBegin in Ubud, Bali's cultural heart, where you'll watch a hypnotic Kecak fire dance, walk through the Sacred Monkey Forest, and take a private cooking class in a traditional family compound. Then descend to the coast — Seminyak's chic beach clubs and Uluwatu's dramatic clifftop temple await, along with a couples' spa ritual using Balinese techniques passed down through generations.\n\nStay in a private pool villa where breakfast is served in your garden and the only sound is birdsong and the distant gamelan. Bali doesn't just offer a holiday — it offers a transformation.",
            'highlights'       => [
                'Kecak fire dance at Uluwatu Temple at sunset',
                'Private couples\' Balinese spa ritual (90 min)',
                'Tegallalang Rice Terrace sunrise walk',
                'Sacred Monkey Forest and Ubud Palace visit',
                'Private Balinese cooking class in a family compound',
                'Tanah Lot Temple at golden hour',
                'Seminyak beach club sunset cocktails',
                'Private pool villa stay with garden breakfast',
            ],
            'inclusions'       => [
                '5 nights private pool villa (2 Ubud + 3 Seminyak)',
                'Daily breakfast served in villa garden',
                'Private AC vehicle for all transfers and tours',
                'Couples\' Balinese spa ritual (90 min)',
                'Kecak fire dance entry tickets at Uluwatu',
                'Private Balinese cooking class',
                'Tanah Lot and Tegallalang guided tour',
                'Welcome fruit basket and flower decoration on arrival',
            ],
            'exclusions'       => [
                'International airfare',
                'Bali visa on arrival fee',
                'Lunches and dinners',
                'Additional spa treatments',
                'Personal expenses and tips',
                'Travel insurance',
                'Any activity not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Bali — Ubud Transfer', 'description' => 'Arrive at Ngurah Rai International Airport. Private transfer to Ubud pool villa. Flower-decorated room welcome. Evening stroll through Ubud Art Market and Ubud Palace. Dinner at a candlelit rice terrace restaurant.'],
                ['day' => 2, 'title' => 'Ubud — Rice Terraces & Monkey Forest', 'description' => 'Sunrise walk through Tegallalang Rice Terraces. Visit Sacred Monkey Forest Sanctuary. Afternoon Ubud Palace and traditional silver jewellery workshop. Evening Kecak fire dance at a local amphitheatre.'],
                ['day' => 3, 'title' => 'Ubud — Cooking Class & Spa', 'description' => 'Morning private Balinese cooking class in a family compound — market visit, cook 5 dishes, eat your creations. Afternoon couples\' Balinese spa ritual at a luxury wellness centre. Sunset dinner in the jungle.'],
                ['day' => 4, 'title' => 'Ubud — Tanah Lot — Seminyak', 'description' => 'Morning drive to Tanah Lot sea temple at golden hour. Continue to Seminyak. Check in to beachfront pool villa. Afternoon beach walk. Sunset cocktails at a Seminyak beach club.'],
                ['day' => 5, 'title' => 'Uluwatu & Kecak at Sunset', 'description' => 'Morning leisure at villa pool. Afternoon drive to Uluwatu — explore the clifftop temple and watch monkeys play above the Indian Ocean. Sunset Kecak fire dance performance. Seafood dinner at Jimbaran Bay.'],
                ['day' => 6, 'title' => 'Depart Bali', 'description' => 'Leisurely garden breakfast. Morning at leisure. Private transfer to Ngurah Rai Airport for your flight home, carrying Bali\'s magic with you.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 2,
            'meta_title'       => 'Romantic Bali Honeymoon Package | Pool Villa, Spa & Uluwatu | UniWorld Holidays',
            'meta_description' => 'Private pool villas, Balinese spa rituals, Uluwatu sunset, and rice terrace walks — 6-day romantic Bali package for couples. Book with UniWorld Holidays.',
        ]);

        // ── Singapore Family Fun ───────────────────────────────────────────
        Tour::where('title', 'Singapore Family Fun')->update([
            'subtitle'         => 'The Lion City — Thrills, Culture & World-Class Attractions',
            'overview'         => "Singapore is the world's greatest family destination — a compact, safe, and endlessly entertaining city-state where Universal Studios sits alongside ancient temples, where a futuristic garden glows with supertrees at night, and where the food is so good that even the hawker centres have Michelin stars. This 5-day family package is designed to keep every generation delighted.\n\nKids will be wide-eyed at Universal Studios Singapore, the S.E.A. Aquarium, and the Night Safari — the world's first nocturnal zoo where tram rides take you past free-roaming animals in the dark. Parents will love the effortless efficiency of the city, the extraordinary food scene spanning Chinese, Malay, Indian, and Peranakan cuisines, and the architectural spectacle of Marina Bay Sands.\n\nBeyond the big attractions, Singapore rewards curious explorers: the colourful shophouses of Little India and Chinatown, the colonial grandeur of the Civic District, and the lush green corridors of the Botanic Gardens (a UNESCO World Heritage Site). Singapore is a city that works perfectly — and a holiday that the whole family will talk about for years.",
            'highlights'       => [
                'Universal Studios Singapore — full day with family',
                'Gardens by the Bay — Supertree Grove and Cloud Forest',
                'Night Safari tram ride at the world\'s first nocturnal zoo',
                'S.E.A. Aquarium — one of the world\'s largest',
                'Marina Bay Sands SkyPark observation deck',
                'Little India and Chinatown heritage walk with street food',
                'Singapore Cable Car ride to Sentosa Island',
                'Hawker centre food trail — chicken rice, laksa, satay',
            ],
            'inclusions'       => [
                '4 nights 4-star hotel near Orchard Road or Marina Bay',
                'Daily breakfast',
                'Return airport transfers in AC vehicle',
                'Universal Studios Singapore 1-day tickets (all ages)',
                'Gardens by the Bay — Cloud Forest and Flower Dome entry',
                'Night Safari tram ride tickets',
                'Singapore Cable Car round trip tickets',
                'Half-day city tour with guide',
            ],
            'exclusions'       => [
                'International airfare',
                'Singapore visa (if applicable)',
                'Lunches and dinners',
                'S.E.A. Aquarium entry (optional add-on)',
                'Marina Bay Sands SkyPark entry',
                'Personal expenses and tips',
                'Travel insurance',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Singapore — Marina Bay', 'description' => 'Arrive at Changi Airport (voted world\'s best). Transfer to hotel. Evening walk along Marina Bay waterfront. View the light-and-water show at Marina Bay Sands. Dinner at a hawker centre — chicken rice and laksa.'],
                ['day' => 2, 'title' => 'Universal Studios Singapore', 'description' => 'Full day at Universal Studios Singapore on Sentosa Island — Jurassic World, Transformers, Minion Park, and more. Cable car ride to Sentosa. Evening return to hotel. Dinner at Vivo City food court.'],
                ['day' => 3, 'title' => 'Gardens by the Bay & Night Safari', 'description' => 'Morning Gardens by the Bay — Cloud Forest waterfall dome and Flower Dome. Afternoon free for shopping on Orchard Road. Evening Night Safari tram ride — spot leopards, tapirs, and flying squirrels in the dark.'],
                ['day' => 4, 'title' => 'City Heritage Trail', 'description' => 'Morning half-day city tour — Merlion Park, Civic District, Little India, Chinatown. Afternoon S.E.A. Aquarium (optional). Evening rooftop dinner with city views.'],
                ['day' => 5, 'title' => 'Depart Singapore', 'description' => 'Breakfast at hotel. Morning free for last-minute shopping at Changi Airport (the airport itself is an attraction — Jewel Changi awaits). Transfer and depart.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Singapore Family Holiday Package | Universal Studios & Night Safari | UniWorld Holidays',
            'meta_description' => 'Universal Studios, Night Safari, Gardens by the Bay, and hawker food trails — 5-day Singapore family package. Book with UniWorld Holidays.',
        ]);

        // ── Thailand Highlights ────────────────────────────────────────────
        Tour::where('title', 'Thailand Highlights')->update([
            'subtitle'         => 'Temples, Islands & the Smile of the Orient',
            'overview'         => "Thailand is Southeast Asia's most beloved destination — a country of staggering contrasts where gilded temples rise above chaotic street markets, where turquoise waters lap at limestone karst islands, and where the warmth of the Thai people makes every traveller feel instantly at home. This 7-day highlights tour covers the essential Thailand: Bangkok's grand temples and vibrant street life, the ancient ruins of Ayutthaya, and the island paradise of Phuket.\n\nBangkok assaults the senses in the best possible way — the Grand Palace's golden spires, the floating markets at dawn, the tuk-tuk rides through narrow lanes, and the rooftop bars where the city spreads to the horizon. A day trip to Ayutthaya, the ancient capital, reveals a civilisation of extraordinary sophistication, its temple ruins draped in tree roots and history.\n\nThen fly south to Phuket, where the Andaman Sea delivers some of the world's most beautiful island scenery. A Phi Phi Islands boat tour, a Thai cooking class, and a beachside massage complete a journey that captures everything that makes Thailand irresistible.",
            'highlights'       => [
                'Grand Palace and Wat Phra Kaew (Emerald Buddha Temple)',
                'Floating market experience at dawn near Bangkok',
                'Ayutthaya ancient ruins day trip by boat',
                'Phi Phi Islands speedboat tour from Phuket',
                'Phang Nga Bay sea kayaking through limestone caves',
                'Thai cooking class with market visit in Phuket',
                'Wat Arun (Temple of Dawn) at sunset on the Chao Phraya',
                'Rooftop bar sundowner over Bangkok skyline',
            ],
            'inclusions'       => [
                '6 nights accommodation (3 Bangkok + 3 Phuket)',
                'Daily breakfast',
                'Bangkok–Phuket domestic flight',
                'Return airport transfers in AC vehicle',
                'Grand Palace and Wat Phra Kaew entry tickets',
                'Ayutthaya day trip by boat with guide',
                'Phi Phi Islands speedboat tour with snorkelling',
                'Thai cooking class in Phuket',
            ],
            'exclusions'       => [
                'International airfare',
                'Thailand visa (if applicable)',
                'Lunches and dinners',
                'Phang Nga Bay kayaking (optional add-on)',
                'Personal expenses and tips',
                'Travel insurance',
                'Any activity not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Bangkok — Riverside & Temples', 'description' => 'Arrive at Suvarnabhumi Airport. Transfer to hotel near the Chao Phraya River. Evening boat ride to Wat Arun at sunset. Dinner at a riverside restaurant with temple views.'],
                ['day' => 2, 'title' => 'Bangkok — Grand Palace & Floating Market', 'description' => 'Early morning floating market visit (Damnoen Saduak or Amphawa). Return to Bangkok. Afternoon Grand Palace and Wat Phra Kaew (Emerald Buddha). Wat Pho reclining Buddha. Evening rooftop bar sundowner.'],
                ['day' => 3, 'title' => 'Ayutthaya Day Trip', 'description' => 'Full day Ayutthaya by boat — cruise up the Chao Phraya to the ancient capital. Explore Wat Mahathat (Buddha head in tree roots), Wat Phra Si Sanphet, and the elephant kraal. Return to Bangkok by evening.'],
                ['day' => 4, 'title' => 'Bangkok — Fly to Phuket', 'description' => 'Morning free for Chatuchak Weekend Market or Jim Thompson House. Afternoon domestic flight to Phuket. Transfer to beachfront hotel. Evening Patong Beach walk and street food dinner.'],
                ['day' => 5, 'title' => 'Phi Phi Islands Speedboat Tour', 'description' => 'Full day speedboat tour to Phi Phi Islands — Maya Bay (The Beach), snorkelling at coral gardens, Viking Cave, and Monkey Beach. Packed lunch on board. Return by sunset.'],
                ['day' => 6, 'title' => 'Phuket — Cooking Class & Phang Nga', 'description' => 'Morning Thai cooking class — market visit, learn 4 dishes, eat your creations. Afternoon optional Phang Nga Bay sea kayaking through limestone caves and James Bond Island. Evening beach massage.'],
                ['day' => 7, 'title' => 'Depart Phuket', 'description' => 'Leisurely breakfast. Morning beach walk. Transfer to Phuket International Airport for your flight home. Sawadee kha — until next time, Thailand.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Thailand Highlights Tour | Bangkok, Ayutthaya & Phuket | UniWorld Holidays',
            'meta_description' => 'Grand Palace, Phi Phi Islands, floating markets, and Thai cooking — 7-day Thailand highlights package. Book with UniWorld Holidays.',
        ]);

        // ── Maldives Overwater Villa ───────────────────────────────────────
        Tour::where('title', 'Maldives Overwater Villa')->update([
            'subtitle'         => 'Barefoot Luxury on the Edge of the Indian Ocean',
            'overview'         => "The Maldives is the closest thing on Earth to paradise — 1,200 coral islands scattered across the Indian Ocean like turquoise jewels, each ringed by house reefs teeming with manta rays, whale sharks, and technicolour coral gardens. This 5-day overwater villa escape is the ultimate luxury retreat: complete seclusion, crystalline water beneath your glass floor, and a horizon that belongs entirely to you.\n\nYour overwater villa extends directly above the lagoon — step off your private deck and snorkel with reef sharks and sea turtles before breakfast. Watch the sunrise paint the water in shades of gold and rose from your sun lounger. As the day unfolds, choose from world-class diving, dolphin cruises, sunset fishing trips, or simply do nothing at all — the Maldives rewards stillness as generously as it rewards adventure.\n\nEvery evening, the resort's overwater restaurant serves freshly caught seafood as the sun melts into the Indian Ocean. This is not just a holiday — it is a complete reset of the senses, a reminder of what the world looks like when it is at its most beautiful.",
            'highlights'       => [
                'Overwater villa with glass floor panel and private deck',
                'House reef snorkelling with reef sharks and sea turtles',
                'Sunset dolphin cruise on the Indian Ocean',
                'Manta ray or whale shark snorkelling excursion (seasonal)',
                'Couples\' overwater spa treatment with ocean views',
                'Traditional Maldivian sunset fishing trip',
                'Sandbank picnic on a deserted island',
                'Underwater restaurant dining experience',
            ],
            'inclusions'       => [
                '4 nights overwater villa on a private island resort',
                'Full board (breakfast, lunch, and dinner)',
                'Speedboat transfers from Malé airport to resort',
                'Sunset dolphin cruise',
                'Sandbank picnic excursion',
                'One snorkelling excursion with marine biologist guide',
                'Couples\' spa treatment (60 min)',
                'Non-motorised water sports (kayak, paddleboard, snorkel gear)',
            ],
            'exclusions'       => [
                'International airfare to Malé',
                'Maldives departure tax',
                'Alcoholic beverages (resort charges apply)',
                'Motorised water sports and diving',
                'Manta ray / whale shark excursion (seasonal, extra cost)',
                'Personal expenses and tips',
                'Travel insurance',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Malé — Speedboat to Resort', 'description' => 'Arrive at Velana International Airport, Malé. Met by resort representative. Speedboat transfer to your private island resort (30–60 min). Butler check-in to overwater villa. Afternoon snorkelling on the house reef. Sunset cocktails on your private deck. Welcome seafood dinner at the overwater restaurant.'],
                ['day' => 2, 'title' => 'House Reef & Dolphin Cruise', 'description' => 'Sunrise from your villa deck. Morning guided house reef snorkel — reef sharks, rays, and turtles. Afternoon at leisure: paddleboard, kayak, or simply float. Sunset dolphin cruise on the Indian Ocean — pods of spinner dolphins are a near-daily sighting.'],
                ['day' => 3, 'title' => 'Sandbank Picnic & Spa', 'description' => 'Morning speedboat to a deserted sandbank — champagne picnic on a strip of white sand surrounded by nothing but ocean. Afternoon couples\' overwater spa treatment with Indian Ocean views. Evening underwater restaurant dinner.'],
                ['day' => 4, 'title' => 'Snorkelling Excursion & Fishing', 'description' => 'Morning guided snorkelling excursion to outer reef with marine biologist — coral gardens, Napoleon wrasse, and schools of tropical fish. Afternoon free. Traditional Maldivian sunset fishing trip — catch and cook option available.'],
                ['day' => 5, 'title' => 'Depart Maldives', 'description' => 'Final sunrise breakfast on your villa deck. Morning at leisure — last swim, last snorkel. Speedboat transfer to Malé airport for your flight home. The Indian Ocean will wait for your return.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 2,
            'meta_title'       => 'Maldives Overwater Villa Package | Dolphins, Snorkelling & Spa | UniWorld Holidays',
            'meta_description' => 'Overwater villa, house reef snorkelling, dolphin cruises, and sandbank picnics — 5-day Maldives luxury escape. Book with UniWorld Holidays.',
        ]);
    }
}
