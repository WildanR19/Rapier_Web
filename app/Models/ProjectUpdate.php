<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    protected $table = "project_updates";
 
    protected $fillable = ['comment', 'project_id', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
