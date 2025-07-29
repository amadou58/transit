<?php

namespace App\Models;

use App\Models\User;
use App\Models\Caisse;
use App\Models\Nature;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Decaissement extends Model
{
    use HasFactory;
    protected $table='decaissement';
    protected $fillable = [
        'date',
        'nature_id',
        'designation',
        'reference',
        'type',
        'montant',
        'commentaire',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class, 'nature_id');
    }


    protected static function booted()
    {
        static::created(function ($decaissement) {
            self::mettreAJourCaisse($decaissement->date);
        });

        static::updated(function ($decaissement) {
            self::mettreAJourCaisse($decaissement->date);
        });

        static::deleted(function ($decaissement) {
            self::mettreAJourCaisse($decaissement->date);
        });
    }

protected static function mettreAJourCaisse($date)
{
    $mois = date('Y-m', strtotime($date));
    $caisse = Caisse::firstOrCreate(['mois' => $mois]);
    $caisse->calculerMontantFinal();
}


}
