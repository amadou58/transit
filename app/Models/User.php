<?php

namespace App\Models;

use App\Models\Transport;
use App\Models\Decaissement;
use App\Models\Encaissement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='users';
    protected $fillable = [
        'prenom',
        'name',
        'email',
        'fonction',
        'image',
        'signature',
        'password',
    ];


    public function decaissement(){
        return $this->hasMany(Decaissement::class, 'user_id');
    }

    public function transport()
    {
        return $this->hasMany(Transport::class, 'user_id');
    }

    public function encaissement()
    {
        return $this->hasMany(Encaissement::class, 'user_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
    ];

    public function isAdmin()
    {
        return $this->fonction === 'Admin';
    }
}
