<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    
    protected $fillable = ['amount', 'pay_date', 'rec_date', 'update_date', 'name_pay'];
}

