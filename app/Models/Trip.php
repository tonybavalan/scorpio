<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'pickup', 'source',
        'drop', 'destination', 'kilometers',
        'is_admin', 'created_by', 'updated_by',
    ];
}
