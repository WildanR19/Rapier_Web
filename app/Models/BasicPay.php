<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicPay extends Model
{
    protected $table = 'basic_pays';

    protected $fillable = [
        'job_id', 'amount'
    ];

    public function payslip()
    {
        return $this->hasMany(Payslip::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
