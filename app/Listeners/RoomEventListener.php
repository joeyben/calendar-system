<?php

namespace App\Listeners;

/**
 * Class RoomEventListener.
 */
class RoomEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Room';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->room->id)
            ->withText('trans("history.rooms.created") <strong>{room}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'room_link' => ['admin.rooms.show', $event->room->name, $event->room->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->room->id)
            ->withText('trans("history.rooms.updated") <strong>{room}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'room_link' => ['admin.rooms.show', $event->room->name, $event->room->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->room->id)
            ->withText('trans("history.rooms.deleted") <strong>{room}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'room_link' => ['admin.rooms.show', $event->room->name, $event->room->id],
            ])
            ->log();
    }






    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Rooms\RoomCreated::class,
            'App\Listeners\RoomEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Rooms\RoomUpdated::class,
            'App\Listeners\RoomEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Rooms\RoomDeleted::class,
            'App\Listeners\RoomEventListener@onDeleted'
        );

    }
}
