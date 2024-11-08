<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Ova linija kodira GET rutu do stranice /home/add-deposit. Kada korisnik pristupi ovoj stranici, poziva se metoda addDeposit unutar HomeController kontrolera.
//Ruti je dodeljeno ime 'home.addDeposit', što omogućava da se ova ruta koristi unutar aplikacije kao route('home.addDeposit'). U sidebar.blade.php, ovo ime je korišćeno kao URL za link "Add deposit".
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');
Route::get('/home/show-add-form', [App\Http\Controllers\HomeController::class, 'showAddForm'])->name('home.showAddForm');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->name('home.addDeposit');