<?php

namespace App\Observers;

use App\Models\Tasks;

class TasksObserver
{
    /**
     * Handle the Tasks "created" event.
     */
    public function created(Tasks $tasks): void
    {
        //
    }

    /**
     * Handle the Tasks "updated" event.
     */
    public function updated(Tasks $tasks): void
    {
        //
    }

    /**
     * Handle the Tasks "deleted" event.
     */
    public function deleted(Tasks $tasks): void
    {
        //
    }

    /**
     * Handle the Tasks "restored" event.
     */
    public function restored(Tasks $tasks): void
    {
        //
    }

    /**
     * Handle the Tasks "force deleted" event.
     */
    public function forceDeleted(Tasks $tasks): void
    {
        //
    }
}
