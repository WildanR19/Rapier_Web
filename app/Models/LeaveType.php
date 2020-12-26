<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'leave_types';

    protected $fillable = [
        'type_name', 'color',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
