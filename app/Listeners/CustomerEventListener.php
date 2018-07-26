<?php

namespace App\Listeners;

/**
 * Class CustomerEventListener.
 */
class CustomerEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Customer';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->customer->id)
            ->withText('trans("history.customers.created") <strong>{customer}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'customer_link' => ['admin.customers.show', $event->customer->first_name.' '.$event->customer->last_name, $event->customer->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->customer->id)
            ->withText('trans("history.customers.updated") <strong>{customer}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'customer_link' => ['admin.customers.show', $event->customer->first_name.' '.$event->customer->last_name, $event->customer->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->customer->id)
            ->withText('trans("history.customers.deleted") <strong>{customer}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'customer_link' => ['admin.customers.show', $event->customer->first_name.' '.$event->customer->last_name, $event->customer->id],
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
            \App\Events\Customers\CustomerCreated::class,
            'App\Listeners\CustomerEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Customers\CustomerUpdated::class,
            'App\Listeners\CustomerEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Customers\CustomerDeleted::class,
            'App\Listeners\CustomerEventListener@onDeleted'
        );

    }
}
