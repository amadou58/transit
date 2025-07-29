<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class CaisseController extends Controller
{
    public function index(Request $request)
    {
       return view("caisse.index");
    }

    public function data(Request $request)
    {
        $query = Caisse::query();

        if ($request->filled('mois')) {
            $query->where('mois', $request->mois);
        }

        return DataTables::of($query->orderByDesc('mois'))
            ->addColumn('total_encaisse', function ($caisse) {
                return DB::table('encaissement')
                    ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$caisse->mois])
                    ->sum('montant');
            })
            ->addColumn('total_decaisse', function ($caisse) {
                return DB::table('decaissement')
                    ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$caisse->mois])
                    ->sum('montant');
            })
            ->addColumn('montant_final', function ($caisse) {
                $total_encaisse = DB::table('encaissement')
                    ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$caisse->mois])
                    ->sum('montant');
                $total_decaisse = DB::table('decaissement')
                    ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$caisse->mois])
                    ->sum('montant');

                return $caisse->montant_initial + $total_encaisse - $total_decaisse;
            })
            ->make(true);
    }

}
