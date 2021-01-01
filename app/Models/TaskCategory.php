<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    protected $table = 'task_category';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
