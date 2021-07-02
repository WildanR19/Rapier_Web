<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    protected $table = 'task_category';

    protected $fillable = ['category_name'];

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
