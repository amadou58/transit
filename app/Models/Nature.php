<?php

namespace App\Models;

use App\Models\Decaissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nature extends Model
{
    use HasFactory;
    protected $table='nature';
    
    protected $fillable = [
        'nom',
        'type',
    ];

    public function decaissement()
    {
        return $this->hasMany(Decaissement::class, 'nature_id');
    }
}
