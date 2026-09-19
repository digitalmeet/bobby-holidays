<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\Quotation;
use App\Models\Tour;
use Database\Seeders\ClientDemoSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientDemoSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_demo_data_is_complete_image_backed_and_idempotent(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $this->seed(ClientDemoSeeder::class);

        $firstCounts = [
            'destinations' => Destination::count(),
            'tours' => Tour::count(),
            'enquiries' => Enquiry::count(),
            'quotations' => Quotation::count(),
            'bookings' => Booking::count(),
            'payments' => Payment::count(),
        ];

        $this->seed(ClientDemoSeeder::class);

        $this->assertSame($firstCounts, [
            'destinations' => Destination::count(),
            'tours' => Tour::count(),
            'enquiries' => Enquiry::count(),
            'quotations' => Quotation::count(),
            'bookings' => Booking::count(),
            'payments' => Payment::count(),
        ]);

        $this->assertGreaterThanOrEqual(7, Destination::whereNotNull('hero_image')->count());
        $this->assertGreaterThanOrEqual(7, Tour::whereNotNull('hero_image')->count());
        $this->assertGreaterThanOrEqual(5, Enquiry::count());
        $this->assertGreaterThanOrEqual(3, Booking::count());
        $this->assertTrue(Booking::where('status', 'partial_paid')->exists());
        $this->assertTrue(Booking::where('status', 'fully_paid')->exists());
        $this->assertTrue(Quotation::where('status', 'sent')->exists());

        foreach (Destination::pluck('hero_image') as $image) {
            $this->assertFileExists(public_path($image));
        }
    }
}
