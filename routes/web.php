<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\RapportController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('clients', ClientController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    
    Route::resource('categories', CategorieController::class)->parameters([
        'categories' =>'categorie'
    ]);
    Route::resource('produits', ProduitController::class);
    Route::resource('achats', AchatController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
   // Supprimez Route::resource et utilisez :
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // ✅ Pas de {profile}
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('rapports', RapportController::class);

});