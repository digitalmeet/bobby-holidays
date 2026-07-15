<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class RichDemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('📍 Updating destinations with rich data...');
        $this->updateDestinations();
        $this->command->info('✅ Step 1 complete — destinations updated.');
    }

    private function updateDestinations(): void
    {
        $data = [

            'Kashmir' => [
                'description' => '<p>Kashmir, often called <strong>Paradise on Earth</strong>, is one of India\'s most breathtaking destinations. Nestled in the northernmost part of the country, it is a land of snow-capped Himalayan peaks, emerald valleys, crystal-clear rivers, and the iconic Dal Lake with its famous houseboats.</p>

<p>The Kashmir Valley stretches across Srinagar, Gulmarg, Pahalgam, and Sonamarg — each offering a distinct experience. Srinagar is the cultural heart, known for its Mughal gardens, wooden mosques, and the serene Shikara rides on Dal Lake. Gulmarg transforms into a snow paradise in winter and a lush meadow in summer, with Asia\'s highest gondola ride. Pahalgam sits along the Lidder River and serves as the base for the Amarnath Yatra, while Sonamarg — the Meadow of Gold — dazzles with glaciers and alpine scenery.</p>

<p>The cuisine of Kashmir is equally legendary. A traditional <em>Wazwan</em> feast featuring Rogan Josh, Yakhni, Gushtaba, and Kahwa tea is an experience in itself. The region is also famous for its handicrafts — Pashmina shawls, hand-knotted carpets, papier-mâché art, and walnut wood carvings.</p>

<p>Whether you are a honeymooner seeking romance, a family looking for a memorable vacation, or an adventure enthusiast craving trekking and skiing — Kashmir delivers an unforgettable experience in every season.</p>',

                'highlights' => [
                    ['highlight' => 'Shikara ride on the iconic Dal Lake at sunrise'],
                    ['highlight' => 'Stay in a traditional houseboat on Dal or Nagin Lake'],
                    ['highlight' => 'Gondola ride at Gulmarg — Asia\'s highest cable car'],
                    ['highlight' => 'Mughal Gardens: Shalimar Bagh, Nishat Bagh, Chashme Shahi'],
                    ['highlight' => 'Snow activities at Gulmarg in winter (skiing, snowboarding)'],
                    ['highlight' => 'Scenic drive through Pahalgam and Betaab Valley'],
                    ['highlight' => 'Authentic Kashmiri Wazwan cuisine experience'],
                    ['highlight' => 'Shopping for Pashmina shawls and hand-knotted carpets'],
                ],
                'meta_title' => 'Kashmir Holiday Packages — Dal Lake, Gulmarg & Pahalgam Tours',
                'meta_description' => 'Explore Kashmir with UniWorld Holidays. Houseboat stays, Gulmarg gondola, Mughal gardens, and personalised Kashmir tour packages starting from ₹24,999.',
            ],

            'Goa' => [
                'description' => '<p>Goa, India\'s smallest state, is the country\'s most beloved beach destination — a vibrant blend of <strong>Portuguese heritage, golden beaches, and a laid-back coastal lifestyle</strong>. Stretching along the Arabian Sea, Goa offers something for every kind of traveller: party-goers, families, couples, history buffs, and food lovers alike.</p>

<p>North Goa is the energetic hub — Baga, Calangute, Anjuna, and Vagator beaches are lined with shacks, water sports operators, and beach clubs. The famous Anjuna Flea Market and Arpora Night Bazaar are must-visits for shopping. South Goa, in contrast, is quieter and more refined — Palolem, Agonda, and Colva beaches offer pristine sands and a more relaxed atmosphere.</p>

<p>Beyond the beaches, Goa\'s Portuguese legacy is visible in its <em>Latin Quarter of Fontainhas</em>, the Basilica of Bom Jesus (a UNESCO World Heritage Site), Se Cathedral, and the charming colonial architecture of Panaji. Old Goa is a treasure trove of 16th-century churches and convents.</p>

<p>Goan cuisine is a delicious fusion of Indian and Portuguese flavours — fresh seafood, Goan fish curry with rice, prawn balchão, bebinca dessert, and the famous feni liquor. Whether you visit for the beaches, the food, the nightlife, or the culture, Goa never disappoints.</p>',

                'highlights' => [
                    ['highlight' => 'Water sports at Baga & Calangute — parasailing, jet ski, banana boat'],
                    ['highlight' => 'Sunset cruise on the Mandovi River with live music'],
                    ['highlight' => 'Visit Basilica of Bom Jesus — UNESCO World Heritage Site'],
                    ['highlight' => 'Explore the Latin Quarter of Fontainhas in Panaji'],
                    ['highlight' => 'Fresh seafood at beachside shacks in South Goa'],
                    ['highlight' => 'Anjuna Flea Market and Arpora Saturday Night Bazaar'],
                    ['highlight' => 'Dudhsagar Waterfalls jeep safari through the jungle'],
                    ['highlight' => 'Spice plantation tour with traditional Goan lunch'],
                ],
                'meta_title' => 'Goa Holiday Packages — Beach, Heritage & Water Sports Tours',
                'meta_description' => 'Plan your Goa trip with UniWorld Holidays. Beach stays, water sports, heritage tours, and customised Goa packages starting from ₹15,999.',
            ],

            'Kerala' => [
                'description' => '<p>Kerala, aptly named <strong>God\'s Own Country</strong>, is a tropical paradise on India\'s southwestern coast. Blessed with an extraordinary diversity of landscapes — serene backwaters, misty hill stations, pristine beaches, dense rainforests, and wildlife sanctuaries — Kerala offers one of India\'s most complete travel experiences.</p>

<p>The <em>Kerala Backwaters</em> are the state\'s crown jewel. A network of interconnected canals, rivers, lakes, and inlets stretching over 900 km, the backwaters are best explored on a traditional <strong>kettuvallam (houseboat)</strong>. Alleppey (Alappuzha) is the gateway to this experience, while Kumarakom offers a quieter, more luxurious alternative.</p>

<p>Munnar, perched at 1,600 metres in the Western Ghats, is a breathtaking hill station carpeted with tea plantations. The rolling green hills, cool misty mornings, and the aroma of fresh tea make it one of South India\'s most romantic destinations. Nearby Eravikulam National Park is home to the endangered Nilgiri Tahr.</p>

<p>Kerala is also the birthplace of <em>Ayurveda</em> — the ancient science of holistic healing. World-class Ayurvedic resorts and wellness centres offer authentic treatments, yoga retreats, and rejuvenation therapies. The state\'s cuisine — coconut-based curries, appam with stew, Kerala fish curry, and banana leaf meals — is equally nourishing for the soul.</p>',

                'highlights' => [
                    ['highlight' => 'Overnight houseboat cruise through Alleppey backwaters'],
                    ['highlight' => 'Tea plantation walks and factory tour in Munnar'],
                    ['highlight' => 'Kathakali dance performance — Kerala\'s classical art form'],
                    ['highlight' => 'Ayurvedic spa and wellness treatments at a heritage resort'],
                    ['highlight' => 'Wildlife safari at Periyar Tiger Reserve, Thekkady'],
                    ['highlight' => 'Varkala cliff beach — red laterite cliffs over the Arabian Sea'],
                    ['highlight' => 'Spice garden tour in Cardamom Hills'],
                    ['highlight' => 'Traditional Kerala Sadya (banana leaf feast)'],
                ],
                'meta_title' => 'Kerala Holiday Packages — Backwaters, Munnar & Ayurveda Tours',
                'meta_description' => 'Discover God\'s Own Country with UniWorld Holidays. Houseboat stays, Munnar tea gardens, Ayurveda retreats, and Kerala packages starting from ₹26,999.',
            ],

            'Himachal Pradesh' => [
                'description' => '<p>Himachal Pradesh is the <strong>crown of North India</strong> — a Himalayan state of extraordinary beauty where snow-capped peaks, apple orchards, ancient temples, and adventure trails come together in perfect harmony. From the colonial charm of Shimla to the adventure capital of Manali, from the spiritual valleys of Spiti to the Tibetan culture of Dharamshala, Himachal offers an experience for every kind of traveller.</p>

<p><strong>Shimla</strong>, the former summer capital of British India, retains its colonial elegance with the famous Mall Road, Christ Church, and the toy train journey through the Shivalik hills — a UNESCO World Heritage railway. <strong>Manali</strong> sits at the confluence of the Beas River and the Himalayan ranges, offering adventure sports, the Rohtang Pass, Solang Valley, and the ancient Hadimba Temple.</p>

<p><strong>Dharamshala and McLeod Ganj</strong> are home to the Tibetan government-in-exile and the Dalai Lama\'s residence, giving the region a unique Tibetan Buddhist character. The <em>Spiti Valley</em> — a cold desert mountain valley — is one of India\'s most dramatic landscapes, with ancient monasteries perched on clifftops and villages untouched by time.</p>

<p>Himachal is also India\'s premier adventure destination — trekking, paragliding in Bir Billing (the paragliding capital of Asia), river rafting on the Beas, mountain biking, and skiing at Kufri and Solang Valley attract thrill-seekers year-round.</p>',

                'highlights' => [
                    ['highlight' => 'Toy train ride on the Kalka-Shimla UNESCO Heritage Railway'],
                    ['highlight' => 'Rohtang Pass snow experience and Solang Valley adventure'],
                    ['highlight' => 'Paragliding at Bir Billing — Asia\'s paragliding capital'],
                    ['highlight' => 'Visit Hadimba Temple and Old Manali village'],
                    ['highlight' => 'River rafting on the Beas River near Kullu'],
                    ['highlight' => 'Spiti Valley monasteries — Key, Tabo, and Dhankar'],
                    ['highlight' => 'Apple orchard walks in Kinnaur and Kullu Valley'],
                    ['highlight' => 'Tibetan culture and monasteries in McLeod Ganj'],
                ],
                'meta_title' => 'Himachal Pradesh Holiday Packages — Shimla, Manali & Spiti Tours',
                'meta_description' => 'Explore Himachal Pradesh with UniWorld Holidays. Shimla, Manali, Dharamshala, and adventure packages starting from ₹21,999.',
            ],

            'Rajasthan' => [
                'description' => '<p>Rajasthan — the <strong>Land of Kings</strong> — is India\'s most regal destination. A vast tapestry of golden deserts, magnificent forts, ornate palaces, vibrant bazaars, and living traditions, Rajasthan is a destination that overwhelms the senses and captures the imagination like no other.</p>

<p><strong>Jaipur</strong>, the Pink City, is the gateway to Rajasthan — home to the Amber Fort, City Palace, Hawa Mahal, and Jantar Mantar (UNESCO World Heritage Site). <strong>Udaipur</strong>, the City of Lakes, is considered one of the most romantic cities in the world, with the Lake Palace floating on Pichola Lake and the grand City Palace complex. <strong>Jodhpur</strong>, the Blue City, is dominated by the imposing Mehrangarh Fort, while <strong>Jaisalmer</strong> — the Golden City — rises from the Thar Desert like a mirage.</p>

<p>The <em>Thar Desert</em> offers one of India\'s most unique experiences — camel safaris at sunset, sleeping under a canopy of stars at a desert camp, and witnessing the dramatic landscape of sand dunes stretching to the horizon. The desert festivals of Jaisalmer and Pushkar are among India\'s most colourful cultural events.</p>

<p>Rajasthani cuisine is bold and flavourful — Dal Baati Churma, Laal Maas, Gatte ki Sabzi, and Ghewar are culinary experiences not to be missed. The state\'s handicrafts — block-printed textiles, blue pottery, miniature paintings, and silver jewellery — make for exceptional souvenirs.</p>',

                'highlights' => [
                    ['highlight' => 'Amber Fort elephant ride and light & sound show, Jaipur'],
                    ['highlight' => 'Sunset camel safari over Thar Desert sand dunes, Jaisalmer'],
                    ['highlight' => 'Boat ride on Lake Pichola with views of Lake Palace, Udaipur'],
                    ['highlight' => 'Mehrangarh Fort — one of India\'s largest and most imposing forts'],
                    ['highlight' => 'Desert camp stay under the stars in Jaisalmer'],
                    ['highlight' => 'Hawa Mahal, City Palace, and Jantar Mantar in Jaipur'],
                    ['highlight' => 'Pushkar Camel Fair (seasonal) — one of the world\'s largest'],
                    ['highlight' => 'Traditional Rajasthani folk music and dance performance'],
                ],
                'meta_title' => 'Rajasthan Holiday Packages — Jaipur, Udaipur, Jodhpur & Jaisalmer Tours',
                'meta_description' => 'Explore Royal Rajasthan with UniWorld Holidays. Forts, palaces, desert safaris, and Rajasthan circuit packages starting from ₹45,999.',
            ],

            'Dubai' => [
                'description' => '<p>Dubai is the <strong>city of superlatives</strong> — the world\'s tallest building, the largest shopping mall, the most luxurious hotels, and the most ambitious man-made islands. Yet beneath the glittering skyline lies a rich Emirati culture, a fascinating old city, and a desert landscape of timeless beauty.</p>

<p>The <strong>Burj Khalifa</strong>, soaring 828 metres above the city, is the undisputed icon of modern Dubai. The Dubai Mall at its base is not just a shopping destination but an entertainment complex with an indoor ice rink, an aquarium, a VR park, and the spectacular Dubai Fountain show. <strong>Palm Jumeirah</strong> — the palm-shaped artificial island — is home to the iconic Atlantis resort and some of the world\'s most exclusive beachfront properties.</p>

<p>Old Dubai offers a fascinating contrast — the <em>Al Fahidi Historical Neighbourhood</em> with its wind-tower architecture, the Dubai Museum, the Gold Souk, and the Spice Souk connected by traditional abra (wooden boat) rides across the Dubai Creek. The <strong>Dubai Frame</strong> offers a unique perspective — old Dubai on one side, new Dubai on the other.</p>

<p>The <em>desert safari</em> is Dubai\'s most iconic experience — dune bashing in 4x4 vehicles, camel riding, sandboarding, falconry demonstrations, and a traditional Bedouin camp dinner under the stars. Dubai\'s culinary scene spans everything from street-side shawarma to Michelin-starred restaurants, making it a true global food destination.</p>',

                'highlights' => [
                    ['highlight' => 'Burj Khalifa At The Top observation deck — views from 555m'],
                    ['highlight' => 'Desert safari with dune bashing, camel ride & BBQ dinner'],
                    ['highlight' => 'Dubai Mall, Dubai Fountain show & Dubai Aquarium'],
                    ['highlight' => 'Dhow cruise dinner on Dubai Creek with live entertainment'],
                    ['highlight' => 'Palm Jumeirah and Atlantis Aquaventure Waterpark'],
                    ['highlight' => 'Gold Souk, Spice Souk and abra ride across Dubai Creek'],
                    ['highlight' => 'Dubai Frame — panoramic views of old and new Dubai'],
                    ['highlight' => 'Global Village and IMG Worlds of Adventure (seasonal)'],
                ],
                'meta_title' => 'Dubai Holiday Packages — Burj Khalifa, Desert Safari & City Tours',
                'meta_description' => 'Explore Dubai with UniWorld Holidays. Burj Khalifa, desert safari, dhow cruise, and Dubai packages starting from ₹49,999.',
            ],

            'Bali' => [
                'description' => '<p>Bali — the <strong>Island of the Gods</strong> — is Indonesia\'s most enchanting destination and one of the world\'s most beloved travel spots. A magical blend of dramatic volcanic landscapes, terraced rice paddies, ancient Hindu temples, pristine beaches, and a deeply spiritual culture, Bali captivates every visitor who sets foot on its shores.</p>

<p><strong>Ubud</strong>, Bali\'s cultural heart, is set amid lush jungle and rice terraces. It is home to the Sacred Monkey Forest, the Tegallalang Rice Terraces, traditional Balinese dance performances, and a thriving arts and wellness scene. The <strong>Seminyak and Kuta</strong> areas offer Bali\'s most vibrant beach scene — world-class surf breaks, beach clubs, sunset cocktails, and a buzzing nightlife.</p>

<p>Bali\'s temples are among the most photogenic in the world. <em>Tanah Lot</em> — perched on a rocky outcrop in the sea — is most spectacular at sunset. <em>Uluwatu Temple</em> on the clifftops of the Bukit Peninsula offers dramatic ocean views and the famous Kecak fire dance at dusk. <em>Besakih</em>, the Mother Temple on the slopes of Mount Agung, is Bali\'s most sacred site.</p>

<p>For honeymooners, Bali is simply unmatched — private pool villas, romantic cliff-top dinners, couples\' spa treatments, and flower-strewn beds are standard offerings. The island\'s warm hospitality, the <em>Balinese Hindu</em> culture with its daily offerings and ceremonies, and the sheer natural beauty make Bali a destination that stays with you forever.</p>',

                'highlights' => [
                    ['highlight' => 'Tegallalang Rice Terraces walk and swing experience, Ubud'],
                    ['highlight' => 'Tanah Lot Temple sunset — Bali\'s most iconic photograph'],
                    ['highlight' => 'Kecak fire dance at Uluwatu Temple at dusk'],
                    ['highlight' => 'Private pool villa stay — the ultimate Bali luxury'],
                    ['highlight' => 'Sacred Monkey Forest Sanctuary in Ubud'],
                    ['highlight' => 'Mount Batur sunrise trek — active volcano at 1,717m'],
                    ['highlight' => 'Balinese cooking class and traditional spa treatment'],
                    ['highlight' => 'Seminyak beach clubs and world-class surf at Kuta'],
                ],
                'meta_title' => 'Bali Holiday Packages — Ubud, Seminyak & Honeymoon Tours',
                'meta_description' => 'Discover Bali with UniWorld Holidays. Rice terraces, temple tours, private villas, and Bali honeymoon packages starting from ₹64,999.',
            ],

            'Singapore' => [
                'description' => '<p>Singapore — the <strong>Lion City</strong> — is one of Asia\'s most remarkable success stories: a tiny island nation that has transformed itself into a global hub of finance, culture, cuisine, and innovation. Clean, safe, efficient, and endlessly fascinating, Singapore is the perfect destination for families, couples, and first-time international travellers.</p>

<p><strong>Gardens by the Bay</strong> is Singapore\'s most spectacular attraction — the iconic Supertree Grove, the Cloud Forest dome with its indoor waterfall, and the Flower Dome housing plants from five Mediterranean climates. The <strong>Marina Bay Sands</strong> SkyPark offers a 360-degree view of the city skyline, while the infinity pool is one of the world\'s most photographed.</p>

<p><strong>Sentosa Island</strong> is Singapore\'s entertainment hub — home to Universal Studios Singapore, S.E.A. Aquarium (one of the world\'s largest), Adventure Cove Waterpark, and pristine beaches. <em>Orchard Road</em> is Asia\'s premier shopping boulevard, while the <strong>Hawker Centres</strong> — Newton, Lau Pa Sat, Maxwell — offer some of the world\'s best street food at remarkably affordable prices.</p>

<p>Singapore\'s multicultural character is its greatest charm — <em>Chinatown</em>, <em>Little India</em>, and <em>Kampong Glam (Arab Street)</em> each offer distinct cultural experiences within walking distance of each other. The city\'s world-class public transport, English-speaking population, and zero-tolerance safety record make it the easiest international destination for Indian families.</p>',

                'highlights' => [
                    ['highlight' => 'Gardens by the Bay — Supertree Grove and Cloud Forest dome'],
                    ['highlight' => 'Universal Studios Singapore — thrills for the whole family'],
                    ['highlight' => 'Marina Bay Sands SkyPark and infinity pool views'],
                    ['highlight' => 'S.E.A. Aquarium — one of the world\'s largest aquariums'],
                    ['highlight' => 'Singapore Zoo and Night Safari — world\'s best nocturnal zoo'],
                    ['highlight' => 'Hawker Centre food trail — Michelin-starred street food'],
                    ['highlight' => 'Chinatown, Little India, and Kampong Glam cultural walk'],
                    ['highlight' => 'Cable car ride to Sentosa Island and Siloso Beach'],
                ],
                'meta_title' => 'Singapore Holiday Packages — Gardens by the Bay, Sentosa & Family Tours',
                'meta_description' => 'Explore Singapore with UniWorld Holidays. Universal Studios, Gardens by the Bay, family-friendly tours, and Singapore packages starting from ₹59,999.',
            ],

            'Thailand' => [
                'description' => '<p>Thailand — the <strong>Land of Smiles</strong> — is Southeast Asia\'s most visited destination, and for good reason. A country of extraordinary contrasts, Thailand offers ancient temples and modern cities, pristine islands and jungle-clad mountains, world-class cuisine and legendary hospitality — all at exceptional value.</p>

<p><strong>Bangkok</strong>, the capital, is a sensory overload in the best possible way — the Grand Palace and Wat Phra Kaew (Temple of the Emerald Buddha), Wat Arun (Temple of Dawn) on the Chao Phraya River, the floating markets of Damnoen Saduak, and the legendary street food scene of Yaowarat (Chinatown) and Khao San Road. The city\'s rooftop bars, luxury malls, and vibrant nightlife make it one of Asia\'s most exciting urban destinations.</p>

<p><strong>Chiang Mai</strong> in northern Thailand is a world apart — a city of 300 ancient temples, elephant sanctuaries, hill tribe villages, and the famous Sunday Walking Street market. The <em>Doi Inthanon National Park</em> and the misty mountains of the north offer trekking, zip-lining, and white-water rafting.</p>

<p>Thailand\'s islands are legendary — <strong>Phuket</strong> for its beaches and nightlife, <strong>Koh Samui</strong> for luxury resorts, <strong>Koh Phi Phi</strong> for dramatic limestone cliffs and crystal waters, and <strong>Koh Lanta</strong> for a quieter, more authentic experience. Thai cuisine — Pad Thai, Tom Yum, Green Curry, Mango Sticky Rice — is among the world\'s most beloved.</p>',

                'highlights' => [
                    ['highlight' => 'Grand Palace and Wat Phra Kaew (Emerald Buddha), Bangkok'],
                    ['highlight' => 'Floating market experience at Damnoen Saduak'],
                    ['highlight' => 'Elephant sanctuary visit in Chiang Mai — ethical interaction'],
                    ['highlight' => 'Island hopping — Phi Phi, Maya Bay, and Phang Nga Bay'],
                    ['highlight' => 'Thai cooking class — learn to make authentic Thai dishes'],
                    ['highlight' => 'Wat Arun sunset cruise on the Chao Phraya River'],
                    ['highlight' => 'Patong Beach, Bangla Road nightlife, and Phuket viewpoints'],
                    ['highlight' => 'Traditional Thai massage at a heritage spa'],
                ],
                'meta_title' => 'Thailand Holiday Packages — Bangkok, Phuket & Chiang Mai Tours',
                'meta_description' => 'Explore Thailand with UniWorld Holidays. Bangkok temples, Phuket beaches, Chiang Mai elephants, and Thailand packages starting from ₹39,999.',
            ],

            'Maldives' => [
                'description' => '<p>The Maldives — a <strong>necklace of 1,200 coral islands</strong> scattered across the Indian Ocean — is the world\'s ultimate luxury escape. With the clearest waters on the planet, the most vibrant coral reefs, and the iconic overwater bungalows that have become synonymous with paradise, the Maldives is the destination that defines the word <em>breathtaking</em>.</p>

<p>Each resort in the Maldives occupies its own private island — a concept unique to this destination. <strong>Overwater villas</strong> with glass floors, private infinity pools, and direct lagoon access are the signature experience. The turquoise lagoons are so clear that you can see the coral and fish from your villa\'s deck. Sunrise and sunset views from an overwater bungalow are among the most spectacular sights on Earth.</p>

<p>The <em>underwater world</em> of the Maldives is extraordinary — home to manta rays, whale sharks, sea turtles, reef sharks, and thousands of species of tropical fish. Snorkelling directly from your villa\'s steps or from the resort\'s house reef is a daily ritual. World-class dive sites, submarine tours, and underwater restaurants add to the magic.</p>

<p>Beyond the water, the Maldives offers <strong>spa experiences</strong> that are unmatched — overwater treatment rooms, couples\' massages with ocean views, and holistic wellness programmes. The cuisine ranges from fresh Maldivian seafood to international fine dining, with many resorts offering private beach dinners under the stars. For honeymooners and anniversary couples, the Maldives is simply the world\'s most romantic destination.</p>',

                'highlights' => [
                    ['highlight' => 'Overwater villa stay with direct lagoon access and glass floor'],
                    ['highlight' => 'Snorkelling with manta rays and whale sharks'],
                    ['highlight' => 'Private beach dinner under the stars'],
                    ['highlight' => 'Sunset dolphin cruise on a traditional dhoni boat'],
                    ['highlight' => 'Underwater restaurant dining experience'],
                    ['highlight' => 'Couples\' spa treatment in an overwater treatment room'],
                    ['highlight' => 'Scuba diving at world-class coral reef dive sites'],
                    ['highlight' => 'Seaplane transfer — aerial views of the atolls'],
                ],
                'meta_title' => 'Maldives Holiday Packages — Overwater Villas & Luxury Resort Tours',
                'meta_description' => 'Experience the Maldives with UniWorld Holidays. Overwater villas, snorkelling, private beach dinners, and Maldives packages starting from ₹1,49,999.',
            ],

        ];

        foreach ($data as $name => $fields) {
            $updated = Destination::where('name', $name)->update([
                'description'      => $fields['description'],
                'highlights'       => json_encode($fields['highlights']),
                'meta_title'       => $fields['meta_title'],
                'meta_description' => $fields['meta_description'],
            ]);
            $this->command->line("  → {$name}: " . ($updated ? '✅ updated' : '⚠️  not found'));
        }
    }
}
