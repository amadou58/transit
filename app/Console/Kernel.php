<?php

namespace App\Console;

use App\Models\Caisse;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            try {
                $moisActuel = now()->format('Y-m');
                $dernier = Caisse::latest()->first();

                if (!Caisse::where('mois', $moisActuel)->exists()) {
                    Caisse::create([
                        'mois' => $moisActuel,
                        'montant_initial' => $dernier?->montant_final ?? 0,
                        'montant_final' => $dernier?->montant_final ?? 0,
                    ]);
                    Log::info("✅ Caisse créée automatiquement pour le mois {$moisActuel}");
                } else {
                    Log::info("⏳ Caisse déjà existante pour {$moisActuel}");
                }

            } catch (\Throwable $e) {
                Log::error("❌ Erreur lors de la création automatique de la caisse : " . $e->getMessage());
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
