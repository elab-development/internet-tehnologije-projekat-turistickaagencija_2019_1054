<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('/',  [App\Http\Controllers\AdController::class, 'index'])->name('welcome');
Route::get('/single-ad/{id}',  [App\Http\Controllers\AdController::class, 'show'])->name('singleAd');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Ova linija kodira GET rutu do stranice /home/add-deposit. Kada korisnik pristupi ovoj stranici, poziva se metoda addDeposit unutar HomeController kontrolera.
//Ruti je dodeljeno ime 'home.addDeposit', što omogućava da se ova ruta koristi unutar aplikacije kao route('home.addDeposit'). U sidebar.blade.php, ovo ime je korišćeno kao URL za link "Add deposit".
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');

//Ova ruta pristupa metodi showAddForm u HomeController-u i poziva view za prikazivanje forme za dodavanje oglasa.
Route::get('/home/show-add-form', [App\Http\Controllers\HomeController::class, 'showAddForm'])->name('home.showAddForm');
Route::get('/home/ad/{id}', [App\Http\Controllers\HomeController::class, 'showSingleAd'])->name('home.singleAd');

Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->name('home.addDeposit');
Route::post('/home/save-ad', [App\Http\Controllers\HomeController::class, 'saveAd'])->name('home.saveAd');