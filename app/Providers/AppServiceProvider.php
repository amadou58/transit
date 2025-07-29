<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'pelle' => 'App\Models\Pelle',
            'camion' => 'App\Models\Camion',
            'voiture' => 'App\Models\Voiture',
            'chargeuse' => 'App\Models\Chargeuse',
            'bull' => 'App\Models\Bull',
            'gradeur' => 'App\Models\Gradeur',
            'pompe' => 'App\Models\Pompe',
            'citerne' => 'App\Models\Citerne',
            'foreuse' => 'App\Models\Foreuse',
            'manitou' => 'App\Models\Manitou',
            'grue' => 'App\Models\Grue',
            'remorque' => 'App\Models\Remorque',
            'groupe' => 'App\Models\GroupeElectro',
            'tower' => 'App\Models\Tower',
            'cuve' => 'App\Models\Cuve',
            'compresseur' => 'App\Models\Compresseur',
            'compacteur' => 'App\Models\Compacteur',
        ]);
    }
}
