<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    public function index(){
     
    }
   
    public function create()
    {
        $nature= Nature::all();
        return view("nature.create", compact('nature'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
        ]);

        $nature = Nature::create([
            'nom'=>$request->nom,
            'type'=>$request->type,
        ]);
        if ($nature->save()) {
            return back()->with("success", "Nature ajoutée avec succès!");
        } else {

            dd($nature->getErrors());
        }
        return redirect('nature');
    }
    

     public function edit(nature $nature){
        return view("nature.edit", compact('nature'));
    }

    public function update(Request $request, nature $nature){
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
        ]);

        $nature->update([
            'nom'=>$request->nom,
            'type'=>$request->type,
        ]);
        if ($nature->save()) {
            return redirect()->route('nature.create')->with("success", "Nature modifiée avec succès!");
        } else {

            dd($nature->getErrors());
        }
        return redirect('nature');
    }
    
    public function destroy($id){
        Nature::findOrFail($id)->delete();
        return back()->with("success", "Nature supprimée avec succès!");
    }
}
