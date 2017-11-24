<?php

namespace App\Listeners;

use App\Events\GameDeletingEvent;
use App\Models\Game;
use App\Notifications\GameSuccessCreating;
use App\Notifications\GameSuccessDeleting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GameDeletingEventListener
{
    /**
     * GameDeletingEventListener constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GameDeletingEvent  $event
     * @return void
     */
    public function handle(GameDeletingEvent $event)
    {
        \Notification::send(auth()->user(), new GameSuccessDeleting($event->gameId));
    }
}
