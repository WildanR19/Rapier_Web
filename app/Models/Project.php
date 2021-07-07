<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'start_date', 'deadline', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class, 'project_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function updates()
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
    
    public function activity()
    {
        return $this->hasMany(ProjectActivity::class);
    }
}
