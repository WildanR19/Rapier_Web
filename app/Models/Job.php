<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
    ];
    
    public function employee_detail()
    {
    	return $this->hasMany(Employee_detail::class);
    }

    public function basic_pay()
    {
    	return $this->hasOne(BasicPay::class);
    }
}
