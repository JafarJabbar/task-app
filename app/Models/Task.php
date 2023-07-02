<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table='tasks';
    protected $fillable=[
      'title',
      'priority',
      'project_id'
    ];
    public function project(){
        return $this->hasOne(Projects::class,'id','project_id');
    }
}
