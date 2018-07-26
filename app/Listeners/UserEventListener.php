<?php

namespace App\Listeners;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'User';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.created") <strong>{user}</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.updated") <strong>{user}</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.restored") <strong>{user}</strong>')
            ->withIcon('refresh')
            ->withClass('bg-aqua')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.permanently_deleted") <strong>{user}</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.changed_password") <strong>{user}</strong>')
            ->withIcon('lock')
            ->withClass('bg-blue')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.deactivated") <strong>{user}</strong>')
            ->withIcon('times')
            ->withClass('bg-yellow')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
            ])
            ->log();
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->user->id)
            ->withText('trans("history.users.reactivated") <strong>{user}</strong>')
            ->withIcon('check')
            ->withClass('bg-green')
            ->withAssets([
                'user_link' => ['admin.users.show', $event->user->name, $event->user->id],
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
            \App\Events\Access\User\UserCreated::class,
            'App\Listeners\UserEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Access\User\UserUpdated::class,
            'App\Listeners\UserEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Access\User\UserDeleted::class,
            'App\Listeners\UserEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Access\User\UserRestored::class,
            'App\Listeners\UserEventListener@onRestored'
        );

        $events->listen(
            \App\Events\Access\User\UserPermanentlyDeleted::class,
            'App\Listeners\UserEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Access\User\UserPasswordChanged::class,
            'App\Listeners\UserEventListener@onPasswordChanged'
        );

        $events->listen(
            \App\Events\Access\User\UserDeactivated::class,
            'App\Listeners\UserEventListener@onDeactivated'
        );

        $events->listen(
            \App\Events\Access\User\UserReactivated::class,
            'App\Listeners\UserEventListener@onReactivated'
        );
    }
}
