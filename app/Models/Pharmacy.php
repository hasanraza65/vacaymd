<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userDetail()
    {
        return $this->belongsTo(User::class,'manager_id');
    }
}
