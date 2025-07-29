<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){

        $user= User::orderBy("id", "desc")->get();
        return view("users.index", compact("user"));
    }

    
    public function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'fonction' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'signature' => ['required', 'image'],
            'password' => ['required', 'confirmed',  Rules\Password::defaults()],
        ]);

       $filename=time()  . '_profil' . '.' . $request->image->extension();
        $path= $request->file('image')->storeAs(
            'photos',
            $filename,
            'public'
        );
        $signat=time() . '_signature' . '.' . $request->signature->extension();
        $sign= $request->file('signature')->storeAs(
            'photos',
            $signat,
            'public'
        );
        
       // $image_path = $request->file('image')->storeAs('image', 'public');

        $user = User::create([
            'prenom'=>$request->prenom,
            'name' => $request->name,
            'fonction' => $request->fonction,
            'email' => $request->email,
            'image'=>$path,
            'signature'=>$sign,
            'password' => Hash::make($request->password),

        ]);
        if ($user->save()) {
          
            return back()->with("success", "Utilisateur ajouté(e) avec succès!");
              
        } else {
            // Erreurs d'enregistrement
            dd($user->getErrors());
        }

       /* event(new Registered($user));

        Auth::login($user);*/

        return redirect('users');
    }
    

     public function edit(User $user){
      // User::find($id);
        return view("users.edit", compact("user"));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'fonction' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        $user->update([
            'prenom'=>$request->prenom,
            'name' => $request->name,
            'fonction' => $request->fonction,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);
        if ($user->update()) {
          
            return back()->with("success", "Utilisateur modifié(e) avec succès!");
              
        } else {
            // Erreurs d'enregistrement
            dd($user->getErrors());
        }
    }

    public function delete($id){
        User::findOrFail($id)->delete();
        return back()->with("success", "Utilisateur supprimé(e) avec succès!");;

    }


}
