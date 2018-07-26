<?php

namespace App\Events\Bookings;

use Illuminate\Queue\SerializesModels;

/**
 * Class BookingDeleted.
 */
class BookingDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $booking;

    /**
     * @param $booking
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }
}
