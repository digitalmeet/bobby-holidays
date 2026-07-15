<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class RichToursStep3Seeder extends Seeder
{
    public function run(): void
    {
        // ── Kerala Backwater Bliss ──────────────────────────────────────────
        Tour::where('title', 'Kerala Backwater Bliss')->update([
            'subtitle'         => 'Drift Through God\'s Own Country',
            'overview'         => "Kerala's backwaters are one of the world's most enchanting waterscapes — a labyrinth of lagoons, lakes, rivers, and canals stretching along the Arabian Sea coast. This 6-day journey takes you deep into the soul of God's Own Country, from the misty tea gardens of Munnar to the tranquil houseboat corridors of Alleppey.\n\nBoard a traditional kettuvallam houseboat and spend a night drifting past paddy fields, coconut groves, and fishing villages where life moves at the pace of the water. Watch local fishermen cast their Chinese fishing nets at dawn, savour freshly caught fish prepared in authentic Kerala style, and let the gentle lapping of water against the hull lull you to sleep under a canopy of stars.\n\nBeyond the backwaters, explore the spice-scented hill stations of Munnar, visit a working tea estate, and unwind on the golden sands of Kovalam beach. Kerala's Ayurvedic heritage adds another dimension — rejuvenating massages and wellness rituals that have been practised for over 3,000 years await you at every stop.",
            'highlights'       => [
                'Overnight houseboat stay on Alleppey backwaters',
                'Sunrise Chinese fishing net experience in Fort Kochi',
                'Guided tea estate walk in Munnar with tasting session',
                'Kathakali classical dance performance in Kochi',
                'Spice plantation tour with aromatic garden walk',
                'Kovalam beach sunset and Ayurvedic massage session',
                'Traditional Kerala Sadya feast on banana leaf',
                'Village canoe ride through narrow backwater channels',
            ],
            'inclusions'       => [
                '5 nights accommodation (2 hotel + 1 houseboat + 2 resort)',
                'Daily breakfast and dinner',
                'One full-day houseboat cruise with all meals',
                'AC vehicle with driver for all transfers',
                'Tea estate guided tour and tasting',
                'Kathakali show entry tickets',
                'Spice plantation tour',
                'Ayurvedic welcome massage (45 min) per person',
            ],
            'exclusions'       => [
                'Airfare to/from Kochi',
                'Lunches (except on houseboat day)',
                'Personal expenses and tips',
                'Camera fees at monuments',
                'Additional Ayurvedic treatments',
                'Travel insurance',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Kochi — Fort Kochi Heritage Walk', 'description' => 'Arrive at Cochin International Airport. Transfer to Fort Kochi hotel. Evening heritage walk through colonial streets, Chinese fishing nets, and St. Francis Church. Welcome dinner with Kerala seafood.'],
                ['day' => 2, 'title' => 'Kochi — Munnar (130 km)', 'description' => 'Post-breakfast drive to Munnar through winding ghats. Visit Cheeyappara Waterfalls en route. Afternoon guided walk through a working tea estate with tasting session. Evening at leisure in the cool hill air.'],
                ['day' => 3, 'title' => 'Munnar — Spice Trails & Eravikulam', 'description' => 'Morning visit to Eravikulam National Park (home of the Nilgiri Tahr). Afternoon spice plantation tour — cardamom, pepper, cinnamon, and vanilla. Kathakali performance in the evening.'],
                ['day' => 4, 'title' => 'Munnar — Alleppey (160 km) — Houseboat', 'description' => 'Drive down to Alleppey. Board your private kettuvallam houseboat by noon. Cruise through the backwater network, passing villages, temples, and paddy fields. All meals on board. Sleep on the water.'],
                ['day' => 5, 'title' => 'Backwaters — Kovalam Beach', 'description' => 'Morning canoe ride through narrow channels. Disembark and drive to Kovalam. Afternoon on the crescent beach. Sunset Ayurvedic massage session at a beachside wellness centre.'],
                ['day' => 6, 'title' => 'Kovalam — Depart Trivandrum', 'description' => 'Leisurely morning on the beach. Transfer to Trivandrum International Airport for your onward journey. Carry home the scent of spices and the sound of water.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Kerala Backwater Bliss Tour | Houseboat & Tea Gardens | UniWorld Holidays',
            'meta_description' => 'Cruise Kerala\'s legendary backwaters on a private houseboat, walk Munnar\'s tea estates, and unwind on Kovalam beach. 6-day all-inclusive Kerala tour from UniWorld Holidays.',
        ]);

        // ── Munnar & Alleppey Romance ──────────────────────────────────────
        Tour::where('title', 'Munnar & Alleppey Romance')->update([
            'subtitle'         => 'A Honeymoon in the Heart of Kerala',
            'overview'         => "Designed exclusively for couples, this 5-day romantic escape weaves together the two most iconic experiences Kerala has to offer — the emerald tea hills of Munnar and the dreamy backwaters of Alleppey. Every detail is curated for intimacy: candlelit dinners, a private houseboat with a sun deck, couples' Ayurvedic rituals, and sunrise walks through mist-draped tea gardens.\n\nMunnar greets you with cool mountain air, rolling carpets of green, and the sweet fragrance of cardamom. Stroll hand-in-hand through tea estates, discover hidden waterfalls, and watch the valley light up at dusk from your hilltop resort. Then descend to Alleppey, where your private houseboat becomes a floating sanctuary — just the two of you, the water, and the stars.\n\nThis is Kerala at its most romantic: unhurried, sensory, and deeply restorative. Perfect for honeymooners and anniversary couples seeking a blend of nature, culture, and wellness.",
            'highlights'       => [
                'Private houseboat with sun deck and candlelit dinner',
                'Couples\' Ayurvedic ritual (60 min Abhyanga massage)',
                'Sunrise walk through Munnar tea gardens',
                'Hidden waterfall picnic experience',
                'Sunset cruise on Vembanad Lake',
                'Flower garden visit at Rajamala (Eravikulam)',
                'Traditional Kerala welcome with flowers and lamp',
                'Romantic beach dinner arrangement at Alleppey',
            ],
            'inclusions'       => [
                '4 nights accommodation (2 hill resort + 1 premium houseboat + 1 beach resort)',
                'Daily breakfast and dinner (candlelit on houseboat)',
                'Couples\' Ayurvedic massage session',
                'Private AC vehicle for all transfers',
                'Flower decoration in room on arrival night',
                'Sunset cruise on Vembanad Lake',
                'Tea estate guided walk',
                'Welcome garland and traditional lamp ceremony',
            ],
            'exclusions'       => [
                'Airfare to/from Kochi',
                'Lunches',
                'Additional spa treatments',
                'Personal shopping and tips',
                'Travel insurance',
                'Any item not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Kochi — Drive to Munnar', 'description' => 'Arrive at Cochin Airport. Traditional welcome with garland and lamp. Drive to Munnar (130 km, ~4 hrs). Check in to hilltop resort with flower-decorated room. Candlelit welcome dinner.'],
                ['day' => 2, 'title' => 'Munnar — Tea Gardens & Waterfall', 'description' => 'Sunrise walk through tea estates. Visit Eravikulam National Park and Rajamala flower gardens. Afternoon hidden waterfall picnic. Evening at leisure with valley views.'],
                ['day' => 3, 'title' => 'Munnar — Alleppey — Houseboat', 'description' => 'Morning drive to Alleppey. Board your private premium houseboat. Cruise through backwater channels. Couples\' Ayurvedic massage on board. Candlelit dinner under the stars.'],
                ['day' => 4, 'title' => 'Backwaters — Sunset Cruise — Beach Resort', 'description' => 'Morning canoe ride. Disembark and transfer to Alleppey beach resort. Afternoon sunset cruise on Vembanad Lake. Romantic beach dinner arrangement in the evening.'],
                ['day' => 5, 'title' => 'Alleppey — Depart Kochi', 'description' => 'Leisurely morning. Transfer to Cochin Airport for your flight home, carrying memories of Kerala\'s timeless beauty.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 2,
            'meta_title'       => 'Munnar & Alleppey Honeymoon Tour | Romantic Kerala Package | UniWorld Holidays',
            'meta_description' => 'Private houseboat, couples\' Ayurveda, and misty tea gardens — Kerala\'s most romantic 5-day honeymoon package for two. Book with UniWorld Holidays.',
        ]);

        // ── Shimla Manali Adventure ────────────────────────────────────────
        Tour::where('title', 'Shimla Manali Adventure')->update([
            'subtitle'         => 'Himalayan Peaks, Snow & Mountain Thrills',
            'overview'         => "The Shimla–Manali corridor is India's most beloved mountain escape — a journey through colonial hill towns, apple orchards, roaring rivers, and snow-capped Himalayan passes. This 7-day adventure takes you from the charming ridge-top promenades of Shimla to the adrenaline-charged valleys of Manali, with every day offering a new landscape and a new thrill.\n\nShimla, the former summer capital of British India, enchants with its Victorian architecture, toy train rides, and panoramic Himalayan views. As you travel north, the scenery transforms dramatically — pine forests give way to barren high-altitude terrain, and the air grows crisp and thin. Manali sits at 2,050 metres and serves as the gateway to Rohtang Pass, Solang Valley, and the legendary Spiti and Lahaul valleys.\n\nFor adventure seekers, the options are endless: river rafting on the Beas, zorbing and paragliding at Solang, snow activities at Rohtang (subject to season), and trekking through Himalayan meadows. For those who prefer a gentler pace, ancient temples, Buddhist monasteries, and apple orchard walks offer equal reward.",
            'highlights'       => [
                'Toy train ride on the UNESCO Kalka–Shimla Railway',
                'Snow activities at Rohtang Pass (seasonal)',
                'River rafting on the Beas River near Kullu',
                'Paragliding and zorbing at Solang Valley',
                'Visit to Hadimba Devi Temple in old-growth deodar forest',
                'Stroll on Shimla\'s colonial Mall Road and The Ridge',
                'Vashisht hot springs and ancient temple complex',
                'Panoramic drive through Kullu Valley apple orchards',
            ],
            'inclusions'       => [
                '6 nights accommodation (2 Shimla + 1 Kullu + 3 Manali)',
                'Daily breakfast and dinner',
                'AC vehicle for all transfers (non-AC on mountain roads)',
                'Toy train ticket (Shimla segment)',
                'River rafting session (Grade II–III)',
                'Solang Valley activity pass (zorbing/rope activities)',
                'Rohtang Pass permit and taxi (seasonal)',
                'All toll, parking, and driver allowances',
            ],
            'exclusions'       => [
                'Airfare to Chandigarh / train to Shimla',
                'Lunches',
                'Paragliding charges (approx ₹2,500/person)',
                'Snow gear rental at Rohtang',
                'Personal expenses and tips',
                'Travel insurance',
                'Any activity not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Shimla — Mall Road & The Ridge', 'description' => 'Arrive at Shimla (by toy train from Kalka or road transfer). Check in to hotel. Evening stroll on Mall Road and The Ridge. Visit Christ Church. Welcome dinner with Himachali cuisine.'],
                ['day' => 2, 'title' => 'Shimla Sightseeing — Kufri & Jakhu', 'description' => 'Morning visit to Jakhu Temple (Hanuman shrine with valley views). Drive to Kufri for horse riding and Himalayan views. Afternoon at leisure on Mall Road. Optional ice skating rink (seasonal).'],
                ['day' => 3, 'title' => 'Shimla — Kullu (235 km)', 'description' => 'Scenic drive through Shivalik hills and Kullu Valley. Stop at Pandoh Dam and Hanogi Mata Temple. Arrive Kullu. Evening river walk along the Beas.'],
                ['day' => 4, 'title' => 'Kullu — River Rafting — Manali', 'description' => 'Morning river rafting on the Beas (Grade II–III rapids). Drive to Manali. Visit Hadimba Devi Temple in the ancient deodar forest. Evening on Mall Road, Manali.'],
                ['day' => 5, 'title' => 'Rohtang Pass / Solang Valley', 'description' => 'Early morning drive to Rohtang Pass (3,978 m) for snow activities — subject to permit availability and weather. Alternatively, full day at Solang Valley for zorbing, rope activities, and paragliding.'],
                ['day' => 6, 'title' => 'Manali — Vashisht — Old Manali', 'description' => 'Morning soak at Vashisht hot springs. Explore Old Manali\'s cafés and Tibetan market. Visit Manu Temple. Afternoon apple orchard walk. Farewell dinner with live folk music.'],
                ['day' => 7, 'title' => 'Manali — Depart', 'description' => 'Early morning departure for Chandigarh/Delhi (overnight bus or private vehicle). Carry home the mountains in your heart.'],
            ],
            'difficulty_level' => 'moderate',
            'min_group_size'   => 2,
            'max_group_size'   => 16,
            'meta_title'       => 'Shimla Manali Adventure Tour | Snow, Rafting & Himalayan Thrills | UniWorld Holidays',
            'meta_description' => 'Toy trains, Rohtang snow, Beas river rafting, and Solang paragliding — 7-day Shimla Manali adventure package. Book with UniWorld Holidays.',
        ]);
    }
}
