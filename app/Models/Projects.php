<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table='projects';
    protected $appends=['tasksCount'];
    private mixed $title;
    protected $fillable=['title'];

    public function getTasksCountAttribute(){
        return Task::select('id')->where('project_id',$this->id)->count();
    }

    public function saveData(string $title){
        $this->title=$title;
        $this->save();
    }
}
