<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cdash;
use App\Http\Controllers\Clogin;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\Cpembuatan;
Route::get('/create', [CobaController::class, 'create'])->name('data-entry.create');
Route::post('/store', [CobaController::class, 'store'])->name('data-entry.store');
// ------------------------------------------------------------------------
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
// Route for the welcome page (accessible to everyone)
Route::get('/', function () {
    return view('dashboard'); // Ensure 'welcome.blade.php' exists
})->name('dashboard'); return view('dashboard');


// Routes for guests (unauthenticated users)
Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [Clogin::class, 'index'])->name('login'); 
    Route::post('/login', [Clogin::class, 'login_proses'])->name('login_proses'); 
}); 

// Redirect /home to main2 for authenticated users
Route::get('/home', function () { 
    return redirect()->route('main2'); 
})->name('home');

// Form routes for both authenticated and guest users (no auth middleware)
Route::get('/pembuatan-user', function () {
    return view('form-db/user');
})->name('pembuatan-user'); // Explicitly naming the route

// Form routes for both authenticated and guest users (no auth middleware)
Route::get('/installasi-pc', function () {
    return view('form-db/pc');
})->name('installasi-pc'); // Explicitly naming the route


Route::get('/perbaikan', function () {
    return view('form-db/perbaikan');
})->name('perbaikan'); // Explicitly naming the route

// Authenticated routes
Route::middleware(['auth'])->group(function () { 
    Route::get('/main2', [Cdash::class, 'index'])->name('main2'); // Main dashboard for authenticated users
    Route::get('/logout', [Clogin::class, 'logout'])->name('logout'); 
});


Route::get('/fetch-data/{nik}', [InstallController::class, 'fetchData']);
// Route::resource()
Route::resource('/form-db/user',Cpembuatan::class);

Route::resource('pembuatan',Cpembuatan::class);


