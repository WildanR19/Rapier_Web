<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = [
        'user_id', 'for_date', 'to_date', 'basic_id', 'payment', 'allowances', 'deductions', 'overtimes', 'others', 'status'
    ];

    public function basic_pay()
    {
        return $this->belongsTo(BasicPay::class, 'basic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
