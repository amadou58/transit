<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\NavigationLog;
use Illuminate\Support\Facades\Auth;

class LogUserNavigation
{
    public function handle(Request $request, Closure $next)
    {
        // Liste des chemins à ignorer
        $ignoredPaths = [
            'data', // ignore toutes les routes contenant /data
            'api',
        ];

        $path = $request->path(); // ex: suivi-groupe/data

        foreach ($ignoredPaths as $ignore) {
            if (str_contains($path, $ignore)) {
                return $next($request);
            }
        }

        if (Auth::check()) {
            NavigationLog::create([
                'user_id' => Auth::id(),
                'url' => $request->url(), // seulement l’URL sans paramètres
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}

