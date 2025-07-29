<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\autorisationabsence;

class GrhController extends Controller
{
        public function index(){
            return view("tableau.index");
            }

        public function accueil(){
            return view("tableau.accueil");
            }

        public function mondepartement(){
            return view("tableau.indexdept");
            }


        public function indexgrh(){
            return view("grh.index");
            }
        public function listeAttenteRh(autorisationabsence $autabs)
        {
            if (auth()->user()->statut === 'drh') {
                $autabs = autorisationabsence::whereNull('drh')
                                                ->whereNotNull('sup_h')
                                                ->whereNotNull('dept')
                                                ->paginate(10);
        
                return view('grh.attenterh', compact('autabs'));
            } else {
                return redirect()->route('grh.index')->with("error", "Vous n'etes pas autorise a acceder");; // Redirige les utilisateurs non RH
            }
        }

        public function someProtectedRoute()
        {
            $this->authorize('accessGrh', auth()->user());
        
            // L'utilisateur a l'autorisation d'accéder à cette route
            return view('grh.index');
        }
}
