<?php

namespace App\Listeners;

/**
 * Class BookingEventListener.
 */
class BookingEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Booking';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->booking->id)
            ->withText('trans("history.bookings.created") <strong>{booking}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'booking_link' => ['admin.bookings.show', $event->booking->getCustomer()[0]->first_name.' '.$event->booking->getCustomer()[0]->last_name.' -> '.$event->booking->getRoom()[0]->name, $event->booking->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->booking->id)
            ->withText('trans("history.bookings.updated") <strong>{booking}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'booking_link' => ['admin.bookings.show', $event->booking->getCustomer()[0]->first_name.' '.$event->booking->getCustomer()[0]->last_name.' -> '.$event->booking->getRoom()[0]->name, $event->booking->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->booking->id)
            ->withText('trans("history.bookings.deleted") <strong>{booking}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'booking_link' => ['admin.bookings.show', $event->booking->getCustomer()[0]->first_name.' '.$event->booking->getCustomer()[0]->last_name.' -> '.$event->booking->getRoom()[0]->name, $event->booking->id],
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
            \App\Events\Bookings\BookingCreated::class,
            'App\Listeners\BookingEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Bookings\BookingUpdated::class,
            'App\Listeners\BookingEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Bookings\BookingDeleted::class,
            'App\Listeners\BookingEventListener@onDeleted'
        );

    }
}
