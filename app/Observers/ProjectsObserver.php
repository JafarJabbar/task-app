<?php

namespace App\Observers;

use App\Models\Projects;
use App\Models\Task;
use Illuminate\Support\Facades\Schema;

class ProjectsObserver
{
    public function __construct()
    {
        Schema::disableForeignKeyConstraints();
    }

    /**
     * Handle the Projects "created" event.
     */
    public function created(Projects $projects): void
    {
        //
    }

    /**
     * Handle the Projects "updated" event.
     */
    public function updated(Projects $projects): void
    {
        //
    }

    /**
     * Handle the Projects "deleted" event.
     */
    public function deleted(Projects $projects): void
    {
        Task::where('project_id',$projects->id)->delete();
    }

    /**
     * Handle the Projects "restored" event.
     */
    public function restored(Projects $projects): void
    {
        Task::where('project_id',$projects->id)->delete();
    }

    /**
     * Handle the Projects "force deleted" event.
     */
    public function forceDeleted(Projects $projects): void
    {
        Task::where('project_id',$projects->id)->delete();
    }
}
