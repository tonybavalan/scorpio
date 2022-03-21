<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name', 'customername', 'email', 'phone_no', 'location', 'latlng', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const VALIDATION_RULES = [
        'customername' => [
            'required',
            'string',
            'max:255'
        ],
        'email' => [
            'required',
            'email',
            'unique:customers,email'
        ],
        'phone_no' => [
            'required',
            'string',
            'unique:customers,phone_no'
        ]
    ];
}
