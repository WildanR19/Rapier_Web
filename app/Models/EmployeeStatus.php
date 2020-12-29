<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    protected $table = 'employee_status';

    protected $fillable = [
        'status_name',
    ];

    public function detail()
    {
        return $this->hasMany(Employee_detail::class);
    }
}
