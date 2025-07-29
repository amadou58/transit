<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function accessGeologie(User $user)
    {
        return $user->isAdmin() || $user->departement->nom_dept === 'Geologie';
    }
    public function accessProduction(User $user)
    {
        return $user->isAdmin() || $user->departement->nom_dept === 'Production';
    }
    public function accessMaintenance(User $user)
    {
        return $user->isAdmin() || $user->departement->nom_dept === 'Maintenance';
    }
    public function accessGrh(User $user)
    {
        return $user->isAdmin() || $user->statut === 'drh';
    }
    public function __construct()
    {
        //
    }
}
