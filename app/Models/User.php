<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'lastname_p',
        'lastname_m',
        'age',
        'birthdate',
        'email',
        'phone',
        'password',
        'active',
        'latitude',
        'longitude',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // //JSON para pruebas de register en API 
    // {
    //     "name" : "bolillo",
    //     "lastname_p": "Pelon",
    //     "lastname_m": "Pistolas",
    //     "age": 12,
    //     "birthdate": "2019-07-27",
    //     "email": "bolo@gmail.com",
    //     "password": "bolillo123",
    //     "phone": "8713578221",
    //     "latitude" : 123,
    //     "longitude" : 321
    // }
}
