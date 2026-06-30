<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user can access admin panel
     */
    public function canAccessAdmin(): bool
    {
        $adminRoles = config('admin-modules.admin_access_roles', []);
        
        return $this->hasAnyRole($adminRoles);
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    // Relationships

    /**
     * Get all enquiries assigned to this user.
     */
    public function assignedEnquiries()
    {
        return $this->hasMany(Enquiry::class, 'assigned_to');
    }

    /**
     * Get all quotations prepared by this user.
     */
    public function preparedQuotations()
    {
        return $this->hasMany(Quotation::class, 'prepared_by');
    }

    /**
     * Get all bookings assigned to this user.
     */
    public function assignedBookings()
    {
        return $this->hasMany(Booking::class, 'assigned_to');
    }

    /**
     * Get all payments recorded by this user.
     */
    public function recordedPayments()
    {
        return $this->hasMany(Payment::class, 'recorded_by');
    }

    /**
     * Get all quotation histories changed by this user.
     */
    public function quotationHistories()
    {
        return $this->hasMany(QuotationHistory::class, 'changed_by');
    }

    /**
     * Get all booking status histories changed by this user.
     */
    public function bookingStatusHistories()
    {
        return $this->hasMany(BookingStatusHistory::class, 'changed_by');
    }

    /**
     * Get all payment histories changed by this user.
     */
    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'changed_by');
    }

    /**
     * Get all posts authored by this user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
