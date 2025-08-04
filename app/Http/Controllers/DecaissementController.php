<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Caisse;
use App\Models\Nature;
use App\Models\Decaissement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DecaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('decaissement.index');
    }

    public function data(Request $request)
    {
        $decaissement = Decaissement::with('nature', 'user')->select('decaissement.*')->orderBy('date', 'desc');

        return DataTables::of($decaissement)
            ->addIndexColumn()
            ->addColumn('nature', function ($row) {
                return $row->nature->nom ?? 'N/A';
            })
            ->addColumn('user', function ($row) {
                return $row->user->prenom. ' '. $row->user->name ?? 'N/A';
            })
            ->addColumn('montant', function ($row) {
                return $row->montant;
            })
            ->addColumn('actions', function ($row) {
                $user = auth()->user();
                
                if ($user->fonction === 'Admin') { 
                    $edit = '<a href="' . route('decaissements.edit', $row->id) . '" class="text-blue-500 hover:text-blue-700 mr-2" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>';
                    $delete = '
                            <button class="text-red-500 hover:text-red-700 delete-decaissement" data-decaissementid="' . $row->id . '" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>';
                    return $edit . $delete;
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function create()
    {
        $natures = Nature::where('type', 'Decaissement')->get();
        return view('decaissement.create', compact('natures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'nature_id' => 'required',
            'designation' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'montant' => 'required',
            'commentaire' => 'required|string|max:255',
        ]);

        $decaissement = Decaissement::create([
            'date'=>$request->date,
            'nature_id' => $request->nature_id,
            'designation' => $request->designation,
            'reference' => $request->reference,
            'type' => $request->type,
            'montant' => $request->montant,
            'commentaire' => $request->commentaire,
            'user_id' => auth()->id(),
        ]);
        if ($decaissement->save()) {
            Caisse::mettreAJourCaisseMoisSuivant($request->date);
            return back()->with("success", "Enregistrement Effectué avec succès!");
        } else {

            dd($decaissement->getErrors());
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Decaissement $decaissement)
    {
        return view('decaissements.show', compact('decaissement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $decaissement = Decaissement::findOrFail($id);
        $natures = Nature::where('type', 'Decaissement')->get();
        return view('decaissement.edit', compact('decaissement', 'natures'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'nature_id' => 'required',
            'designation' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'commentaire' => 'nullable|string|max:255',
        ]);

        // Ajoute manuellement l'user_id
        $validated['user_id'] = auth()->id();

        $decaissement = Decaissement::findOrFail($id);
        $decaissement->update($validated);


        return redirect()->route('decaissements.index')->with("success", "Modification effectuée avec succès !");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(decaissement $decaissement)
    {
        $decaissement->delete();

        return redirect()->route('decaissements.index')->with('success', 'Suppression effectuée avec succès !');
    }
}