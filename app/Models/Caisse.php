<?php

namespace App\Models;

use App\Models\Decaissement;
use App\Models\Encaissement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;
        protected $fillable = [

        'mois',
        'montant_initial',
        'montant_final',
    ];

    public function getTotalEncaissements()
    {
        return Encaissement::whereYear('date', substr($this->mois, 0, 4))
            ->whereMonth('date', substr($this->mois, 5, 2))
            ->sum('montant');
    }

    public function getTotalDecaissements()
    {
        return Decaissement::whereYear('date', substr($this->mois, 0, 4))
            ->whereMonth('date', substr($this->mois, 5, 2))
            ->sum('montant');
    }

    public function calculerMontantFinal()
    {
        $encaisse = $this->getTotalEncaissements();
        $decaisse = $this->getTotalDecaissements();
        $this->montant_final = $this->montant_initial + $encaisse - $decaisse;
        $this->save();
    }


    protected static function mettreAJourCaisseMoisSuivant($date)
    {
        $moisMouvement = date('Y-m', strtotime($date));
        $moisPrecedent = date('Y-m', strtotime($moisMouvement . '-01 -1 month'));

        $caissePrecedente = Caisse::where('mois', $moisPrecedent)->first();

        if (!$caissePrecedente) {
            return; // On ne fait rien si pas de mois précédent
        }

        $caisseSuivante = Caisse::firstOrCreate(
            ['mois' => $moisMouvement],
            ['montant_initial' => $caissePrecedente->montant_final, 'montant_final' => $caissePrecedente->montant_final]
        );

        // Si déjà existant, on met à jour le montant initial
        if (!$caisseSuivante->wasRecentlyCreated) {
            $caisseSuivante->montant_initial = $caissePrecedente->montant_final;
            $caisseSuivante->calculerMontantFinal(); // À condition que cette méthode existe
            $caisseSuivante->save();
        }
    }

    
}
