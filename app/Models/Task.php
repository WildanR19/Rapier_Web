<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'user_id', 'created_by', 'task_category_id', 'priority', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function created_by(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category(){
        return $this->belongsTo(TaskCategory::class,'task_category_id');
    }
}
