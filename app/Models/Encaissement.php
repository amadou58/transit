<?php

namespace App\Models;

use App\Models\User;
use App\Models\Caisse;
use App\Models\Nature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encaissement extends Model
{
    use HasFactory;

    protected $table='encaissement';
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
        static::created(function ($encaissement) {
            self::mettreAJourCaisse($encaissement->date);
        });

        static::updated(function ($encaissement) {
            self::mettreAJourCaisse($encaissement->date);
        });

        static::deleted(function ($encaissement) {
            self::mettreAJourCaisse($encaissement->date);
        });     
    }


protected static function mettreAJourCaisse($date)
{
    $mois = date('Y-m', strtotime($date));
    $caisse = Caisse::firstOrCreate(['mois' => $mois]);
    $caisse->calculerMontantFinal();
}

}


    