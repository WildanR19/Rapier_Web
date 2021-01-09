<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'title', 'user_id', 'due_date', 'progress_percent', 'priority', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
