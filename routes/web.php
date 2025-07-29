<?php
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\GrhController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DecaissementController;
use App\Http\Controllers\EncaissementController;
use App\Http\Controllers\NavigationLogController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

        //   Route::get('/dashboard', function () {
        //       return view('/tableau/index');
        //   })->middleware(['auth', 'verified'])->name('dashboard');
     
        Route::get('/', function(){
            return view('/tableau/accueil');
        })->name('accueil');

        // Route::get('/notifications', 'NotificationController@showNotifications')->name('notifications.show');

        //Tableau
        Route::get('tableau', [GrhController::class, "index"])->name('tableau.index');
        Route::get('accueil', [GrhController::class, "accueil"])->name('tableau.accueil');

        //Routes utilisateur
        Route::get('users', [UserController::class, "index"])->name('users.index');
        Route::get('users/departement', [UserController::class, "userParDept"])->name('users.dept');
        Route::get('users/add', [UserController::class, "create"])->name('create');
        Route::post('users', [UserController::class, 'store'])->name('add');
        Route::get('users/{user}', [UserController::class, "edit"])->name("edit");
        Route::post('users/{user}', [UserController::class, "update"])->name("update");
        Route::delete('users/{user}', [UserController::class, "delete"])->name("delete");
        //Destination
        Route::resource('destination', DestinationController::class);
        //Client
        Route::resource('client', ClientController::class);
        Route::get('/clients/data', [ClientController::class, 'data'])->name('client.data');


        //Transport
        Route::get('/transports/data', [TransportController::class, 'data'])->name('transports.data');
        Route::post('/transports/batch-update', [TransportController::class, 'batchUpdate'])->name('transports.batch-update');
        Route::resource('transports', TransportController::class)->names([
            'index' => 'transports.index',
            'create' => 'transports.create',
            'store' => 'transports.store',
            'show' => 'transports.show',
            'edit' => 'transports.edit',
            'update' => 'transports.update',
            'destroy' => 'transports.destroy',
        ]);

        //nature
        Route::resource('nature', NatureController::class);


        Route::get('decaissements/data', [DecaissementController::class, 'data'])->name('decaissements.data');

        // Les routes RESTful classiques
        //decaissement
        Route::resource('decaissements', DecaissementController::class)->names([
            'index' => 'decaissements.index',
            'data' => 'decaissements.data',
            'create' => 'decaissements.create',
            'store' => 'decaissements.store',
            'show' => 'decaissements.show',
            'edit' => 'decaissements.edit',
            'update' => 'decaissements.update',
            'destroy' => 'decaissements.destroy',
        ]);


        //******************************encaissement****************************//
        Route::get('encaissements/data', [EncaissementController::class, 'data'])->name('encaissements.data');
        Route::resource('encaissements', EncaissementController::class)->names([
            'index' => 'encaissements.index',
            'data' => 'encaissements.data',
            'create' => 'encaissements.create',
            'store' => 'encaissements.store',
            'show' => 'encaissements.show',
            'edit' => 'encaissements.edit',
            'update' => 'encaissements.update',
            'destroy' => 'encaissements.destroy',
        ]);

        //******************************caisse****************************//
        Route::get('/caisses', [CaisseController::class, 'index'])->name('caisses.index');
        Route::get('/caisses/data', [CaisseController::class, 'data'])->name('caisses.data');


        /***************************Journal de Navigation********************************* */
        
        Route::get('/admin/navigation-logs', [NavigationLogController::class, 'index'])->name('navigation-logs.index');
        // Endpoint pour DataTables côté serveur
        Route::get('/admin/navigation-logs/data', [NavigationLogController::class, 'data'])->name('navigation-logs.data');

});


