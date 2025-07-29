<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NavigationLog;
use Yajra\DataTables\Facades\DataTables;

class NavigationLogController extends Controller
{
    //
    public function index()
    {
        return view('navigationlog.index');
    }

    public function data(Request $request)
    {
        $logs = NavigationLog::with('user')->select('navigation_logs.*');

        return DataTables::eloquent($logs)
            ->addColumn('user_name', function ($log) {
                return $log->user ? $log->user->prenom .' '. $log->user->name : 'Utilisateur supprimé';
            })
            ->editColumn('visited_at', function ($log) {
                return $log->visited_at->format('d/m/Y H:i');
            })
            ->make(true);
    }

}
