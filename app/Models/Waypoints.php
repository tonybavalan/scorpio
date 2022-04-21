<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waypoints extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id','route',
    ];
}
