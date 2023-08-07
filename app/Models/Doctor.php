<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }


}
