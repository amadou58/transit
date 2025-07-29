<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use DataTables;

class ClientController extends Controller
{
    public function index()
    {
        return view("client.index");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $clients = Client::select(['id', 'nom', 'prenom', 'adresse', 'contact']);
            return DataTables::of($clients)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $edit = '<a href="'.route('client.edit', $row->id).'" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>';
                    $delete = '<button class="text-red-500 hover:text-red-700 delete-client" data-clientid="'.$row->id.'"><i class="fas fa-trash"></i></button>';
                    return $edit . '&nbsp;&nbsp;' . $delete;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function create()
    {
        return view("client.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
        ]);

        $client = Client::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'contact'=>$request->contact,
        ]);
        if ($client->save()) {
            return back()->with("success", "client ajouté avec succès!");
        } else {

            dd($client->getErrors());
        }
        return redirect('client');
    }
    

    public function edit(Client $client){
        return view("client.edit", compact("client"));
    }

    public function update(Request $request, Client $client){
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
        ]);

        $client->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'contact'=>$request->contact,
        ]);
        if ($client->save()) {
            return redirect()->route('client.create')->with("success", "client modifié avec succès!");
        } else {

            dd($client->getErrors());
        }
        return redirect('client');
    }
    
    public function destroy($id){
        Client::findOrFail($id)->delete();
        return back()->with("success", "client supprimé avec succès!");
    }
}
