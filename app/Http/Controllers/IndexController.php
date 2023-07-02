<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /*
     * Statistics of projects and tasks
     * */
    public function dashboard(){

        //task count
        $countTasks=Task::select('id')->count();

        //project count
        $countProjects=Projects::select('id')->count();

        return view('pages.dashboard',compact('countProjects','countTasks'));
    }
}
