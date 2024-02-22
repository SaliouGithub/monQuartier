<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\HabitantController;
use App\Http\Controllers\DelegueQuartierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


// Route::resource("/utilisateur", UserController::class);
Route::resource("/utilisateur", UserController::class, [
    'names' => [
        'index' => 'pages.user.index',
        'create' => 'pages.user.create',
        'store' => 'pages.user.store',
        'show' => 'pages.user.show',
        'edit' => 'pages.user.edit',
        'update' => 'pages.user.update',
        'destroy' => 'pages.user.destroy',
    ],
]);



Route::get('/commune', [CommuneController::class, 'index'])->name('pages.commune.index');
Route::get('/commune/create', [CommuneController::class, 'create'])->name('pages.commune.create');
Route::post('/commune', [CommuneController::class, 'store'])->name('pages.commune.store');
Route::get('/commune/{id}', [CommuneController::class, 'show'])->name('pages.commune.show');
Route::get('/commune/{id}/edit', [CommuneController::class, 'edit'])->name('pages.commune.edit');
Route::put('/commune/{id}', [CommuneController::class, 'update'])->name('pages.commune.update');
Route::delete('/commune/{id}', [CommuneController::class, 'destroy'])->name('pages.commune.destroy');



Route::get('/quartier', [QuartierController::class, 'index'])->name('pages.quartier.index');
Route::get('/quartier/create', [QuartierController::class, 'create'])->name('pages.quartier.create');
Route::post('/quartier', [QuartierController::class, 'store'])->name('pages.quartier.store');
Route::get('/quartier/{id}', [QuartierController::class, 'show'])->name('pages.quartier.show');
Route::get('/quartier/{id}/edit', [QuartierController::class, 'edit'])->name('pages.quartier.edit');
Route::put('/quartier/{id}', [QuartierController::class, 'update'])->name('pages.quartier.update');
Route::delete('/quartier/{id}', [QuartierController::class, 'destroy'])->name('pages.quartier.destroy');



Route::get('/maison', [MaisonController::class, 'index'])->name('pages.maison.index');
Route::get('/maison/create', [MaisonController::class, 'create'])->name('pages.maison.create');
Route::post('/maison', [MaisonController::class, 'store'])->name('pages.maison.store');
Route::get('/maison/{id}', [MaisonController::class, 'show'])->name('pages.maison.show');
Route::get('/maison/{id}/edit', [MaisonController::class, 'edit'])->name('pages.maison.edit');
Route::put('/maison/{id}', [MaisonController::class, 'update'])->name('pages.maison.update');
Route::delete('/maison/{id}', [MaisonController::class, 'destroy'])->name('pages.maison.destroy');



Route::get('/habitant', [HabitantController::class, 'index'])->name('pages.habitant.index');
Route::get('/habitant/create', [HabitantController::class, 'create'])->name('pages.habitant.create');
Route::post('/habitant', [HabitantController::class, 'store'])->name('pages.habitant.store');
Route::get('/habitant/{id}', [HabitantController::class, 'show'])->name('pages.habitant.show');
Route::get('/habitant/{id}/edit', [HabitantController::class, 'edit'])->name('pages.habitant.edit');
Route::put('/habitant/{id}', [HabitantController::class, 'update'])->name('pages.habitant.update');
Route::delete('/habitant/{id}', [HabitantController::class, 'destroy'])->name('pages.habitant.destroy');



Route::get('delegue', [DelegueQuartierController::class, 'index'])->name('pages.delegue.index');
Route::get('delegue/create', [DelegueQuartierController::class, 'create'])->name('pages.delegue.create');
Route::post('delegue', [DelegueQuartierController::class, 'store'])->name('pages.delegue.store');
Route::get('delegue/{id}', [DelegueQuartierController::class, 'show'])->name('pages.delegue.show');
Route::get('delegue/{id}/edit', [DelegueQuartierController::class, 'edit'])->name('pages.delegue.edit');
Route::put('delegue/{id}', [DelegueQuartierController::class, 'update'])->name('pages.delegue.update');
Route::delete('delegue/{id}', [DelegueQuartierController::class, 'destroy'])->name('pages.delegue.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
