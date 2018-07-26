<?php

namespace App\Events\Rooms;

use Illuminate\Queue\SerializesModels;

/**
 * Class RoomCreated.
 */
class RoomCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $room;

    /**
     * @param $room
     */
    public function __construct($room)
    {
        $this->room = $room;
    }
}
