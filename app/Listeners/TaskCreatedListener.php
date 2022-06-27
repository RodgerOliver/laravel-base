<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\TaskCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskCreatedNotification;

class TaskCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskCreated $event)
    {
        $admins = User::whereHas('roles', function($query){
            $query->where('name', 'master');
        })->get();
        Notification::send($admins, new TaskCreatedNotification($event->task));
    }
}
