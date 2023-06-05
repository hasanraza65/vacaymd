<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderDetail()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
