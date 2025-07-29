<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifiez si l'utilisateur est connecté
        if ($request->user()) {
            $userFunction = $request->user()->fonction;

            // Vérifiez si l'utilisateur a la fonction "Admin"
            if ($userFunction === 'Admin') {
                return $next($request); // L'utilisateur a la fonction "Admin", autorise l'accès
            }

            // Vérifiez si le champ "fonction" de l'utilisateur fait partie des fonctions autorisées
            if (in_array($userFunction, $roles)) {
                return $next($request); // L'utilisateur a le bon champ "fonction", autorise l'accès
            }

            // Si l'utilisateur n'a pas la fonction "Admin" et son champ "fonction" n'est pas autorisé
            // Vérifiez si le champ "nom_dept" correspond à celui spécifié dans les rôles
            $userDepartment = $request->user()->departement->nom_dept;

            if (in_array($userDepartment, $roles)) {
                return $next($request); // L'utilisateur a le bon champ "nom_dept", autorise l'accès
            }
        } else {
            // Redirigez l'utilisateur s'il n'est pas connecté
            return redirect('/login');
        }

        // Redirigez l'utilisateur s'il n'a pas le bon champ "fonction" ou "nom_dept"
        return redirect('/')->with('error', 'Accès non autorisé.');
    }
}
