<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
       protected $guarded = [];

       protected $fillable = ['task_id','comment'];

       public function Task(){
        
        return $this->belongsTo(Task::class);

       }

}
