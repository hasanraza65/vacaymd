<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class,'order_id','id');
    }
    public function passports()
    {
        return $this->hasMany(Passport::class,'order_id','id');
    }
    public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function pharmacyDetail()
    {
        return $this->belongsTo(Pharmacy::class,'pharmacy_id');
    }
    public function doctorDetail()
    {
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function prescriptionDetail()
    {
        return $this->hasMany(Prescription::class,'id','prescription_id');
    }
    public function addons()
    {
        return $this->hasMany(OrderAddon::class,'order_id','id');
    }
    public function prescriptionDetailImg()
    {
        return $this->belongsTo(Prescription::class,'prescription_id');
    }

}
