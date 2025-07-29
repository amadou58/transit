<?php

namespace App\Models;

use App\Models\Transport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $table='client';
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'contact',
    ];

    public function transport()
    {
        return $this->hasMany(Transport::class, 'client_id');
    }
}
