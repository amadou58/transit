<?php

namespace App\Models;

use App\Models\Transport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
    protected $table='destination';
    protected $fillable = [
        'nom',
    ];

    public function transport()
    {
        return $this->hasMany(Transport::class, 'destination_id');
    }
}
