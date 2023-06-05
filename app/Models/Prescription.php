<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function prescriptionMedicines()
    {
        return $this->hasMany(PrescriptionMedicines::class,'prescription_id','id');
    }
}
