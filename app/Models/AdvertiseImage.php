<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'alt', 'url', 'advertise_id'
    ];

    protected $appends = array('image_path');

    public function getImagePathAttribute()
    {
        return 'storages/' . $this->attributes['url'];
    }
}
