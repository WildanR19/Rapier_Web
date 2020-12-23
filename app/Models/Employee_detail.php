<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_detail extends Model
{
    protected $fillable = [
        'user_id', 'address', 'gender', 'job_id', 'department_id', 'join-date',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
