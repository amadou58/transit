<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Paiement;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transport extends Model
{
    use HasFactory;
    protected $table='transport';
    protected $fillable = [
        'date',
        'designation',
        'immatriculation_vehicule',
        'destination_id',
        'numero_declaration',
        'client_id',
        'poids',
        'droit_douane',
        'frais_kati',
        'frais_frontiere',
        'frais_circuit',
        'frais_rapport',
        'frais_ts',
        'total_frais',
        'prix',
        'benefice_esperer',
        'paiement',
        'benefice_reel',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'paiement_id');
    }
}
