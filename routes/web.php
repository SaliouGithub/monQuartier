<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\QuartierController;
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

// Route::resource("/commune", CommuneController::class, [
//     'names' => [
//         'index' => 'pages.commune.index',
//         'create' => 'pages.commune.create',
//         'store' => 'pages.commune.store',
//         'show' => 'pages.commune.show',
//         'edit' => 'pages.commune.edit',
//         'update' => 'pages.commune.update',
//         // 'destroy' => 'pages.commune.destroy',
//     ],
// ]);

Route::get('/commune', [CommuneController::class, 'index'])->name('pages.commune.index');
Route::get('/commune/create', [CommuneController::class, 'create'])->name('pages.commune.create');
Route::post('/commune', [CommuneController::class, 'store'])->name('pages.commune.store');
Route::get('/commune/{id}', [CommuneController::class, 'show'])->name('pages.commune.show');
Route::get('/commune/{id}/edit', [CommuneController::class, 'edit'])->name('pages.commune.edit');
Route::put('/commune/{id}', [CommuneController::class, 'update'])->name('pages.commune.update');
Route::delete('/commune/{id}', [CommuneController::class, 'destroy'])->name('pages.commune.destroy');



// Route::resource("/quartier", QuartierController::class, [
//     'names' => [
//         'index' => 'pages.quartier.index',
//         'create' => 'pages.quartier.create',
//         'store' => 'pages.quartier.store',
//         'show' => 'pages.quartier.show',
//         'edit' => 'pages.quartier.edit',
//         'update' => 'pages.quartier.update',
//         'destroy' => 'pages.quartier.destroy',
//     ],
// ]);

Route::get('/quartier', [QuartierController::class, 'index'])->name('pages.quartier.index');
Route::get('/quartier/create', [QuartierController::class, 'create'])->name('pages.quartier.create');
Route::post('/quartier', [QuartierController::class, 'store'])->name('pages.quartier.store');
Route::get('/quartier/{id}', [QuartierController::class, 'show'])->name('pages.quartier.show');
Route::get('/quartier/{id}/edit', [QuartierController::class, 'edit'])->name('pages.quartier.edit');
Route::put('/quartier/{id}', [QuartierController::class, 'update'])->name('pages.quartier.update');
Route::delete('/quartier/{id}', [QuartierController::class, 'destroy'])->name('pages.quartier.destroy');


 
// Route::get('/utilisateur', [UserController::class, 'index'])->name('pages.user.index');
// Route::get('/commune', [CommuneController::class, 'index'])->name('pages.commune.index');
// Route::get('/quartier', [QuartierController::class, 'index'])->name('pages.quartier.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
