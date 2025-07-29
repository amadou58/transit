<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(){
     
    }
   
    public function create()
    {
        $destination= Destination::all();
        return view("destination.create", compact("destination"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $destination = destination::create([
            'nom'=>$request->nom,
        ]);
        if ($destination->save()) {
            return back()->with("success", "Destination ajoutée avec succès!");
        } else {

            dd($destination->getErrors());
        }
        return redirect('destination');
    }
    

     public function edit(destination $destination){
        return view("destination.edit", compact("destination"));
    }

    public function update(Request $request, destination $destination){
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $destination->update([
            'nom'=>$request->nom,
        ]);
        if ($destination->save()) {
            return redirect()->route('destination.create')->with("success", "Destination modifiée avec succès!");
        } else {

            dd($destination->getErrors());
        }
        return redirect('destination');
    }
    
    public function destroy($id){
        Destination::findOrFail($id)->delete();
        return back()->with("success", "Destination supprimée avec succès!");
    }
}
