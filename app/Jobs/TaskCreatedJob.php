<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\TaskCreated;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskCreatedNotification;

class TaskCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TaskCreated $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send(User::getMasters(), new TaskCreatedNotification($this->event->task));
    }

    /**
     * Execute if job fails.
     *
     * @return void
     */
    public function failed()
    {
        info('TaskCreatedJob failed.');
    }
}
