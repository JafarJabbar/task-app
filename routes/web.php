<?php

use Illuminate\Support\Facades\Route;


//Home page statistics
Route::get('/', [\App\Http\Controllers\IndexController::class,'dashboard'])->name('dashboard');


/*
 * Task CRUD routes
 * */
Route::resource('tasks',\App\Http\Controllers\TaskController::class);
//Tasks reorder route
Route::get('tasks/reorder/list',[\App\Http\Controllers\TaskController::class,'reorder'])->name('tasks.reorder_list');
Route::post('tasks/reorder/action',[\App\Http\Controllers\TaskController::class,'reorder_action'])->name('tasks.reorder_action');



/*
 * Projects CRUD routes
 * */
Route::resource('projects',\App\Http\Controllers\ProjectsController::class);
