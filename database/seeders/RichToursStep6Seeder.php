<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\TourPricing;

class RichToursStep6Seeder extends Seeder
{
    public function run(): void
    {
        // Validity windows — Standard & Deluxe valid all year, Premium peak season
        $allYear   = ['valid_from' => '2025-01-01', 'valid_until' => '2025-12-31'];
        $peakSeason = ['valid_from' => '2025-10-01', 'valid_until' => '2026-03-31'];

        // [tour_title, standard_id, deluxe_id, premium_price, premium_child, infant_price]
        $tours = [
            ['Kashmir Delight',           1,  2,  49999,  34999, 2500],
            ['Kashmir Honeymoon Special', 3,  4,  64999,  null,  null],
            ['Goa Beach Carnival',        5,  6,  31999,  22399, 1500],
            ['Kerala Backwater Bliss',    7,  8,  56999,  39899, 2000],
            ['Munnar & Alleppey Romance', 9,  10, 52999,  null,  null],
            ['Shimla Manali Adventure',   11, 12, 43999,  30799, 2000],
            ['Royal Rajasthan Circuit',   13, 14, 89999,  62999, 3000],
            ['Dubai Explorer',            15, 16, 99999,  69999, 4000],
            ['Dubai Luxury Escape',       17, 18, 179999, 125999, 5000],
            ['Romantic Bali',             19, 20, 129999, null,  null],
            ['Singapore Family Fun',      21, 22, 119999, 83999, 4000],
            ['Thailand Highlights',       23, 24, 79999,  55999, 3000],
            ['Maldives Overwater Villa',  25, 26, 299999, null,  null],
        ];

        foreach ($tours as [$title, $stdId, $dlxId, $premPrice, $premChild, $infantPrice]) {
            $tour = Tour::where('title', $title)->first();
            if (! $tour) continue;

            // Update Standard tier
            TourPricing::where('id', $stdId)->update(array_merge($allYear, [
                'infant_price' => $infantPrice ?? 0,
                'sort_order'   => 1,
            ]));

            // Update Deluxe tier
            TourPricing::where('id', $dlxId)->update(array_merge($allYear, [
                'infant_price' => $infantPrice ?? 0,
                'sort_order'   => 2,
            ]));

            // Insert Premium tier (skip if already exists)
            TourPricing::firstOrCreate(
                ['tour_id' => $tour->id, 'label' => 'Premium'],
                array_merge($peakSeason, [
                    'price_per_person' => $premPrice,
                    'child_price'      => $premChild ?? 0,
                    'infant_price'     => $infantPrice ?? 0,
                    'currency'         => 'INR',
                    'is_active'        => true,
                    'sort_order'       => 3,
                ])
            );
        }
    }
}
