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
            ->addColumn('total_frais', fn($row) => number_format($row->total_frais, 2))
            ->addColumn('prix', fn($row) => number_format($row->prix, 2))
            ->addColumn('benefice_esperer', fn($row) => number_format($row->benefice_esperer, 2))
            ->addColumn('paiement', fn($row) => number_format($row->paiement, 2))
            ->addColumn('benefice_reel', fn($row) => number_format($row->benefice_reel, 2))
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

            // Calcul des frais
            $total_frais = $validated['droit_douane'] + $validated['frais_kati'] + $validated['frais_frontiere']
                        + $validated['frais_circuit'] + $validated['frais_rapport'] + $validated['frais_ts'];

            $benefice_esperer = $validated['prix'] - $total_frais;
            $benefice_reel = $validated['paiement'] - $total_frais;

            // Enregistrement
            $transport = Transport::create([
                'date' => $validated['date'],
                'designation' => $validated['designation'],
                'immatriculation_vehicule' => $validated['immatriculation_vehicule'],
                'destination_id' => $validated['destination_id'],
                'numero_declaration' => $validated['numero_declaration'],
                'client_id' => $validated['client_id'],
                'poids' => $validated['poids'],
                'droit_douane' => $validated['droit_douane'],
                'frais_kati' => $validated['frais_kati'],
                'frais_frontiere' => $validated['frais_frontiere'],
                'frais_circuit' => $validated['frais_circuit'],
                'frais_rapport' => $validated['frais_rapport'],
                'frais_ts' => $validated['frais_ts'],
                'total_frais' => $total_frais,
                'prix' => $validated['prix'],
                'benefice_esperer' => $benefice_esperer,
                'paiement' => $validated['paiement'],
                'benefice_reel' => $benefice_reel,
                'user_id' => auth()->id(),
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

        // Calculs
        $total_frais = $validated['droit_douane'] + $validated['frais_kati'] + $validated['frais_frontiere']
                    + $validated['frais_circuit'] + $validated['frais_rapport'] + $validated['frais_ts'];

        $benefice_esperer = $validated['prix'] - $total_frais;
        $benefice_reel = $validated['paiement'] - $total_frais;

        // Mise à jour
        $transport->update([
            'date' => $validated['date'],
            'designation' => $validated['designation'],
            'immatriculation_vehicule' => $validated['immatriculation_vehicule'],
            'destination_id' => $validated['destination_id'],
            'numero_declaration' => $validated['numero_declaration'],
            'client_id' => $validated['client_id'],
            'poids' => $validated['poids'],
            'droit_douane' => $validated['droit_douane'],
            'frais_kati' => $validated['frais_kati'],
            'frais_frontiere' => $validated['frais_frontiere'],
            'frais_circuit' => $validated['frais_circuit'],
            'frais_rapport' => $validated['frais_rapport'],
            'frais_ts' => $validated['frais_ts'],
            'total_frais' => $total_frais,
            'prix' => $validated['prix'],
            'benefice_esperer' => $benefice_esperer,
            'paiement' => $validated['paiement'],
            'benefice_reel' => $benefice_reel,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('transports.index')->with('success', 'Transport mis à jour avec succès !');
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

            // Mise à jour du champ demandé
            $transport->$field = $value;

            // Recalcul des frais et bénéfices
            $total_frais = $transport->droit_douane + $transport->frais_kati + $transport->frais_frontiere
                        + $transport->frais_circuit + $transport->frais_rapport + $transport->frais_ts;

            $benefice_esperer = $transport->prix - $total_frais;
            $benefice_reel = $transport->paiement - $total_frais;

            $transport->total_frais = $total_frais;
            $transport->benefice_esperer = $benefice_esperer;
            $transport->benefice_reel = $benefice_reel;

            $transport->save();
        }

        return response()->json(['status' => 'success']);
    }



}
