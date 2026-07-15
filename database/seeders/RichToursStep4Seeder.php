<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class RichToursStep4Seeder extends Seeder
{
    public function run(): void
    {
        // ── Royal Rajasthan Circuit ────────────────────────────────────────
        Tour::where('title', 'Royal Rajasthan Circuit')->update([
            'subtitle'         => 'Palaces, Forts & the Colours of the Desert',
            'overview'         => "Rajasthan is India at its most theatrical — a land where maharajas built sky-piercing forts, where camels plod across amber dunes at sunset, and where every city is painted a different colour. This 8-day royal circuit connects the four crown jewels of the state: Jaipur (the Pink City), Jodhpur (the Blue City), Jaisalmer (the Golden City), and Udaipur (the City of Lakes).\n\nBegin in Jaipur, where the Amber Fort rises dramatically above a lake and the Hawa Mahal's 953 windows catch the morning breeze. Travel west to Jodhpur, where the colossal Mehrangarh Fort dominates a sea of indigo-washed houses. Push deeper into the Thar Desert to Jaisalmer, where a living medieval fort still houses families, temples, and havelis carved from golden sandstone. End in Udaipur, arguably India's most romantic city, where white marble palaces float on shimmering lakes.\n\nThroughout the journey, heritage hotels — some converted from actual royal residences — immerse you in Rajput grandeur. Folk music, puppet shows, camel rides, and royal thali dinners complete an experience that feels less like a holiday and more like a passage through time.",
            'highlights'       => [
                'Sunrise visit to Amber Fort with elephant pathway views',
                'Mehrangarh Fort audio tour with panoramic Jodhpur views',
                'Camel safari into the Thar Desert at Sam Sand Dunes',
                'Overnight desert camp with folk music and bonfire',
                'Jaisalmer Fort — a living UNESCO World Heritage Site',
                'Sunset boat ride on Lake Pichola, Udaipur',
                'City Palace complex tour in Udaipur',
                'Royal Rajasthani thali dinner in a heritage haveli',
            ],
            'inclusions'       => [
                '7 nights accommodation (2 Jaipur + 1 Jodhpur + 2 Jaisalmer + 2 Udaipur)',
                'Daily breakfast and dinner',
                'AC vehicle with driver for all intercity transfers',
                'Camel safari and desert camp with dinner and folk show',
                'Boat ride on Lake Pichola',
                'Amber Fort entry and guide',
                'Mehrangarh Fort entry and audio guide',
                'All toll, parking, and driver allowances',
            ],
            'exclusions'       => [
                'Airfare to Jaipur / from Udaipur',
                'Lunches',
                'Monument entry fees not listed above',
                'Personal expenses and tips',
                'Travel insurance',
                'Elephant ride at Amber Fort (optional, extra cost)',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Jaipur — Pink City Orientation', 'description' => 'Arrive at Jaipur Airport. Transfer to hotel. Evening walk on Johari Bazaar and view of Hawa Mahal lit up at night. Welcome dinner with Rajasthani dal baati churma.'],
                ['day' => 2, 'title' => 'Jaipur — Amber Fort & City Palace', 'description' => 'Sunrise drive to Amber Fort — explore the Sheesh Mahal (Hall of Mirrors) and Diwan-e-Aam. Afternoon City Palace museum and Jantar Mantar observatory. Evening at Chokhi Dhani cultural village.'],
                ['day' => 3, 'title' => 'Jaipur — Jodhpur (340 km)', 'description' => 'Morning drive to Jodhpur. En route stop at Ajmer Sharif Dargah and Pushkar Lake (optional). Arrive Jodhpur. Evening stroll through the blue lanes of the old city.'],
                ['day' => 4, 'title' => 'Jodhpur — Mehrangarh Fort & Umaid Bhawan', 'description' => 'Morning Mehrangarh Fort audio tour — one of India\'s largest forts with sweeping desert views. Visit Jaswant Thada cenotaph. Afternoon Umaid Bhawan Palace museum. Drive to Jaisalmer (290 km).'],
                ['day' => 5, 'title' => 'Jaisalmer — Living Fort & Havelis', 'description' => 'Morning inside Jaisalmer Fort — Jain temples, royal palace, and rooftop views. Afternoon Patwon Ki Haveli and Salim Singh Ki Haveli. Sunset at Gadisar Lake.'],
                ['day' => 6, 'title' => 'Jaisalmer — Desert Safari & Camp', 'description' => 'Morning at leisure. Afternoon camel safari to Sam Sand Dunes. Sunset over the Thar. Overnight at luxury desert camp with Rajasthani folk music, dance, and bonfire dinner.'],
                ['day' => 7, 'title' => 'Jaisalmer — Udaipur (500 km / fly)', 'description' => 'Morning drive or fly to Udaipur. Check in to lake-view hotel. Evening sunset boat ride on Lake Pichola with views of the Lake Palace and Jag Mandir.'],
                ['day' => 8, 'title' => 'Udaipur — City Palace & Depart', 'description' => 'Morning City Palace complex tour and Saheliyon Ki Bari garden. Afternoon Shilpgram crafts village. Transfer to Udaipur Airport for onward journey.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Royal Rajasthan Circuit Tour | Jaipur Jodhpur Jaisalmer Udaipur | UniWorld Holidays',
            'meta_description' => 'Forts, palaces, desert camps, and lake sunsets — 8-day Royal Rajasthan Circuit covering Jaipur, Jodhpur, Jaisalmer & Udaipur. Book with UniWorld Holidays.',
        ]);

        // ── Dubai Explorer ─────────────────────────────────────────────────
        Tour::where('title', 'Dubai Explorer')->update([
            'subtitle'         => 'The City of the Future Meets the Soul of Arabia',
            'overview'         => "Dubai is a city that defies superlatives — the world's tallest building, the largest mall, the longest driverless metro, and yet, just 45 minutes from the gleaming skyline, rolling red dunes stretch to the horizon and Bedouin traditions live on. This 5-day Dubai Explorer package is designed to show you both faces of this extraordinary city.\n\nStand at the top of the Burj Khalifa as the sun sets over the Arabian Gulf. Wander through the gold and spice souks of Deira, where the scent of oud and saffron fills the air. Cross the Creek on an abra (traditional wooden boat) and step into the old city of Al Fahidi, where wind towers and coral-stone buildings tell a story that predates the skyscrapers by centuries.\n\nThen head into the desert for a thrilling dune bashing safari, a camel ride at sunset, and a traditional Bedouin camp dinner under a sky blazing with stars. Whether you're shopping in the world's most glamorous malls, skiing indoors at Ski Dubai, or watching the Dubai Fountain dance to music, every hour in this city delivers something extraordinary.",
            'highlights'       => [
                'Burj Khalifa At the Top (124th floor) at sunset',
                'Dubai Fountain show from the waterfront promenade',
                'Desert safari with dune bashing and Bedouin camp dinner',
                'Gold Souk and Spice Souk walking tour in Deira',
                'Abra (wooden boat) ride across Dubai Creek',
                'Al Fahidi Historical Neighbourhood heritage walk',
                'Dubai Mall and Dubai Frame visit',
                'Palm Jumeirah monorail and Atlantis viewpoint',
            ],
            'inclusions'       => [
                '4 nights 4-star hotel accommodation in Dubai',
                'Daily breakfast',
                'Return airport transfers in AC vehicle',
                'Burj Khalifa At the Top ticket (124th floor)',
                'Desert safari with BBQ dinner and entertainment',
                'Dubai city tour (half day) with guide',
                'Dhow cruise dinner on Dubai Creek',
                'All transfers for included activities',
            ],
            'exclusions'       => [
                'International airfare',
                'UAE visa charges',
                'Lunches and dinners (except dhow cruise and desert camp)',
                'Ski Dubai entry',
                'Personal shopping and tips',
                'Travel insurance',
                'Any activity not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Dubai — Creek & Old City', 'description' => 'Arrive at Dubai International Airport. Transfer to hotel. Evening abra ride across Dubai Creek. Walk through Gold Souk and Spice Souk. Dinner at a traditional Arabic restaurant in Al Fahidi.'],
                ['day' => 2, 'title' => 'Modern Dubai — Burj Khalifa & Downtown', 'description' => 'Morning Dubai city tour — Jumeirah Mosque, Palm Jumeirah, Burj Al Arab exterior. Afternoon Dubai Mall. Sunset Burj Khalifa At the Top (124th floor). Evening Dubai Fountain show from the waterfront.'],
                ['day' => 3, 'title' => 'Desert Safari', 'description' => 'Morning at leisure (optional Ski Dubai or Dubai Frame). Afternoon pick-up for desert safari — dune bashing in 4x4, camel ride, sandboarding, henna painting. Bedouin camp BBQ dinner with tanoura dance and fire show.'],
                ['day' => 4, 'title' => 'Dhow Cruise & Free Day', 'description' => 'Morning free for shopping at Dubai Mall or Mall of the Emirates. Afternoon Dubai Frame visit. Evening traditional dhow cruise dinner on Dubai Creek with live music.'],
                ['day' => 5, 'title' => 'Depart Dubai', 'description' => 'Breakfast at hotel. Leisure time until check-out. Transfer to Dubai International Airport for your flight home.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 20,
            'meta_title'       => 'Dubai Explorer Tour Package | Burj Khalifa, Desert Safari & More | UniWorld Holidays',
            'meta_description' => 'Burj Khalifa sunsets, desert dune bashing, gold souks, and dhow dinners — 5-day Dubai Explorer package. Book with UniWorld Holidays.',
        ]);

        // ── Dubai Luxury Escape ────────────────────────────────────────────
        Tour::where('title', 'Dubai Luxury Escape')->update([
            'subtitle'         => 'Five-Star Indulgence in the Arabian Gulf',
            'overview'         => "For those who want Dubai at its most opulent, the Dubai Luxury Escape delivers an experience where every detail is elevated. Stay in a 5-star beachfront resort on Jumeirah Beach, dine at award-winning restaurants, and experience the city's most exclusive attractions — from a private desert camp under the stars to a seaplane flight over the Palm Jumeirah.\n\nThis 6-day itinerary is crafted for discerning travellers who appreciate the finer things: butler service, private transfers in luxury vehicles, priority access to the Burj Khalifa's exclusive 148th-floor SKY lounge, and a sunset yacht cruise along the Dubai Marina. Every meal is a destination in itself — from a rooftop Arabic feast overlooking the city to a seafood dinner at a Michelin-recommended waterfront restaurant.\n\nBeyond the glamour, this package also reveals Dubai's cultural soul — a private guided tour of the Al Fahidi district, a visit to the Louvre Abu Dhabi (day trip), and an evening at the Dubai Opera. This is Dubai for those who refuse to compromise.",
            'highlights'       => [
                'Burj Khalifa SKY lounge (148th floor) — exclusive access',
                'Sunset private yacht cruise along Dubai Marina',
                'Seaplane flight over Palm Jumeirah and The World islands',
                'Private luxury desert camp with gourmet Bedouin dinner',
                'Day trip to Louvre Abu Dhabi',
                'Dubai Opera evening performance',
                'Private Al Fahidi heritage tour with expert guide',
                'Michelin-recommended seafood dinner at Dubai waterfront',
            ],
            'inclusions'       => [
                '5 nights 5-star beachfront hotel (Jumeirah Beach)',
                'Daily breakfast and 2 gourmet dinners',
                'Private luxury vehicle for all transfers',
                'Burj Khalifa SKY (148th floor) tickets',
                'Private sunset yacht cruise (2 hours)',
                'Seaplane flight over Palm Jumeirah (15 min)',
                'Private luxury desert camp with gourmet dinner',
                'Louvre Abu Dhabi entry and private guide',
            ],
            'exclusions'       => [
                'International airfare',
                'UAE visa charges',
                'Remaining lunches and dinners',
                'Dubai Opera tickets (arranged on request)',
                'Personal shopping and spa treatments',
                'Travel insurance',
                'Any item not listed under inclusions',
            ],
            'itinerary'        => [
                ['day' => 1, 'title' => 'Arrive Dubai — Luxury Welcome', 'description' => 'Arrive at Dubai International Airport. Private luxury vehicle transfer to 5-star Jumeirah Beach resort. Butler-assisted check-in with welcome amenities. Evening rooftop Arabic dinner with city views.'],
                ['day' => 2, 'title' => 'Iconic Dubai — SKY Lounge & Marina Yacht', 'description' => 'Morning Dubai city highlights tour in private vehicle. Afternoon Burj Khalifa SKY lounge (148th floor) — champagne at the top. Evening private sunset yacht cruise along Dubai Marina with canapés.'],
                ['day' => 3, 'title' => 'Seaplane & Cultural Dubai', 'description' => 'Morning seaplane flight over Palm Jumeirah and The World islands (15 min). Afternoon private heritage tour of Al Fahidi district with expert guide. Evening Dubai Opera performance.'],
                ['day' => 4, 'title' => 'Luxury Desert Experience', 'description' => 'Morning beach leisure at the resort. Afternoon private luxury desert camp transfer. Sundowner cocktails on the dunes. Gourmet Bedouin dinner under the stars with private entertainment.'],
                ['day' => 5, 'title' => 'Day Trip — Louvre Abu Dhabi', 'description' => 'Private vehicle day trip to Abu Dhabi. Louvre Abu Dhabi with private guide — world-class art in an architectural masterpiece. Michelin-recommended seafood dinner on the Dubai waterfront on return.'],
                ['day' => 6, 'title' => 'Depart Dubai', 'description' => 'Leisurely breakfast. Spa morning at the resort (own account). Private luxury transfer to Dubai International Airport for your flight home.'],
            ],
            'difficulty_level' => 'easy',
            'min_group_size'   => 2,
            'max_group_size'   => 10,
            'meta_title'       => 'Dubai Luxury Escape | 5-Star Yacht, Seaplane & Desert Camp | UniWorld Holidays',
            'meta_description' => '5-star beachfront hotel, Burj Khalifa SKY lounge, private yacht, seaplane over Palm Jumeirah — 6-day Dubai luxury package. Book with UniWorld Holidays.',
        ]);
    }
}
