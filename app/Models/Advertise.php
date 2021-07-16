<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'user_id', 'category_id'
    ];

}
