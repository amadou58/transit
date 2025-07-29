<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Client;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transport.index');
    }

    public function data(Request $request)
    {
        $transports = Transport::with(['destination', 'client', 'user'])->select('transport.*');

        return DataTables::of($transports)
            ->addIndexColumn()
            ->addColumn('destination', fn($row) => $row->destination->nom ?? 'N/A')
            ->addColumn('client', fn($row) => $row->client->prenom. ' ' .$row->client->nom ?? 'N/A')
            ->addColumn('droit_douane', fn($row) => number_format($row->droit_douane, 2))
            ->addColumn('frais_kati', fn($row) => number_format($row->frais_kati, 2))
            ->addColumn('frais_frontiere', fn($row) => number_format($row->frais_frontiere, 2))
            ->addColumn('frais_circuit', fn($row) => number_format($row->frais_circuit, 2))
            ->addColumn('frais_rapport', fn($row) => number_format($row->frais_rapport, 2))
            ->addColumn('frais_ts', fn($row) => number_format($row->frais_ts, 2))
            ->addColumn('prix', fn($row) => number_format($row->prix, 2))
            ->addColumn('paiement', fn($row) => number_format($row->paiement, 2))
            ->addColumn('benefice', fn($row) => number_format($row->benefice, 2))
            ->addColumn('user', fn($row) => $row->user->prenom. ' ' .$row->user->name ?? 'N/A')
            ->addColumn('actions', function ($row) {
                $edit = '<a href="' . route('transports.edit', $row->id) . '" class="text-blue-500 hover:text-blue-700 mr-2" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>';
                $delete = '<button class="text-red-500 hover:text-red-700 delete-transport" data-id="' . $row->id . '" title="Supprimer">
                                <i class="fas fa-trash"></i>
                        </button>';
                return $edit . $delete;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = Destination::all();
        $clients = Client::all();
        return view('transport.create', compact('destinations', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'designation' => 'required|string|max:255',
            'immatriculation_vehicule' => 'required|string|max:255',
            'destination_id' => 'required|exists:destination,id',
            'numero_declaration' => 'required|string|max:255',
            'client_id' => 'required|exists:client,id',
            'poids' => 'required|numeric',
            'droit_douane' => 'required|numeric',
            'frais_kati' => 'required',
            'frais_frontiere' => 'required',
            'frais_circuit' => 'required',
            'frais_rapport' => 'required',
            'frais_ts' => 'required',
            'prix' => 'required',
            'paiement' => 'required',
        ]);
            
        
        $benefice = (($request->input('paiement')) - ($request->input('prix')));

       $transport = Transport::create([
            'date'=>$request->date,
            'designation' => $request->designation,
            'immatriculation_vehicule' => $request->immatriculation_vehicule,
            'destination_id' => $request->destination_id,
            'numero_declaration' => $request->numero_declaration,
            'client_id' => $request->client_id,
            'poids' => $request->poids,
            'droit_douane' => $request->droit_douane,
            'frais_kati' => $request->frais_kati,
            'frais_frontiere' => $request->frais_frontiere,
            'frais_circuit' => $request->frais_circuit,
            'frais_rapport' => $request->frais_rapport,
            'frais_ts' => $request->frais_ts,
            'prix' => $request->prix,
            'paiement' => $request->paiement,
            'benefice' => $benefice,
            'user_id'=>auth()->id(),
        ]);
        if ($transport->save()) {
            return back()->with("success", "Enregistrement Effectué avec succès!");
        } else {

            dd($transport->getErrors());
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        return view('transports.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        $destinations = Destination::all();
        $clients = Client::all();
        return view('transport.edit', compact('transport', 'destinations', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'designation' => 'required|string|max:255',
            'immatriculation_vehicule' => 'required|string|max:255',
            'destination_id' => 'required|exists:destination,id',
            'numero_declaration' => 'required|string|max:255',
            'client_id' => 'required|exists:client,id',
            'poids' => 'required|numeric',
            'droit_douane' => 'required|numeric',
            'frais_kati' => 'required|numeric',
            'frais_frontiere' => 'required|numeric',
            'frais_circuit' => 'required|numeric',
            'frais_rapport' => 'required|numeric',
            'frais_ts' => 'required|numeric',
            'prix' => 'required|numeric',
            'paiement' => 'required|numeric',
        ]);

        // Ajoute manuellement l'user_id
        $validated['user_id'] = auth()->id();

        $transport->update($validated);

        return redirect()->route('transports.index')->with('success', 'Transport updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();

        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully!');
    }

    public function batchUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'field' => 'required|string|in:droit_douane,frais_kati,frais_frontiere,frais_circuit,frais_rapport,frais_ts',
            'value' => 'required|numeric'
        ]);

        $field = $request->field;
        $value = $request->value;

        // Récupère les transports concernés
        $transports = Transport::whereIn('id', $request->ids)->get();

        foreach ($transports as $transport) {
            // Vérifie si la valeur actuelle du champ est différente de NULL ou 0
            if (!is_null($transport->$field) && $transport->$field != 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Impossible de modifier l'enregistrement ID {$transport->id} car le champ `$field` a déjà une valeur : {$transport->$field}."
                ], 403);
            }

            // Sinon, mettre à jour le champ (facultatif ici si tu veux appliquer à la volée)
            $transport->update([
                $field => $value
            ]);
        }

        return response()->json(['status' => 'success']);
    }


}
