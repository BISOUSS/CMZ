<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

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
Route::get('/service', function () {
    return view('dash.service');
});
Route::get('/produit', function () {
    return view('dash.produit');
});
Route::get('/projet', function () {
    return view('dash.projet');
});
Route::get('/references', function () {
    return view('dash.references');
});
Route::get('/devis', function () {
    return view('dash.devis');
});
Route::get('/login', function () {
    return view('dash.login');
});
Route::get('/contact', function () {
    return view('dash.contact');
});
Route::get('/commentaire', function () {
    return view('dash.commentaire');
});
Route::get('/index', function () {
    return view('dash.index');
});
Route::resource('service', ServiceController::class);

Route::get('/dashboard', function () {
    return view('dash.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
