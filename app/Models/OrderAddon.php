<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function itemDetail()
    {
        return $this->belongsTo(UpSaleItem::class,'item_id');
    }
}
