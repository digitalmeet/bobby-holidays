<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class BookingPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any bookings.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'bookings');
    }

    /**
     * Determine whether the user can view the booking.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'view', 'bookings');
    }

    /**
     * Determine whether the user can create bookings.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'bookings');
    }

    /**
     * Determine whether the user can update the booking.
     */
    public function update(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'edit', 'bookings');
    }

    /**
     * Determine whether the user can delete the booking.
     */
    public function delete(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'delete', 'bookings');
    }

    /**
     * Determine whether the user can restore the booking.
     */
    public function restore(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'restore', 'bookings');
    }

    /**
     * Determine whether the user can permanently delete the booking.
     */
    public function forceDelete(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'force_delete', 'bookings');
    }

    /**
     * Determine whether the user can cancel the booking.
     */
    public function cancel(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'cancel', 'bookings');
    }

    /**
     * Determine whether the user can complete the booking.
     */
    public function complete(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'complete', 'bookings');
    }

    /**
     * Determine whether the user can confirm the booking.
     */
    public function confirm(User $user, Booking $booking): bool
    {
        return $this->canPerform($user, 'confirm', 'bookings');
    }
}