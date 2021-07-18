<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiseField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'value', 'advertise_id'
    ];

    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
}
