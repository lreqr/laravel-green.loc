<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreenController;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

Route::get('/', [GreenController::class, 'index'])->name('index');
//Listings routes
Route::prefix('listings')->group(function (){

    //Show Create Listing Form
   Route::get('/create', [GreenController::class, 'create'])
       ->name('listings.create')
       ->middleware('auth');

   //Show Manage Listings Page
    Route::get('/manage', [GreenController::class, 'manage'])
        ->name('listings.manage')
        ->middleware('auth');

    //Show Single Listing Page
   Route::get('/{listing}', [GreenController::class, 'show'])->name('listings.show');

    //Show Edit Single Listing
   Route::get('/{listing}/edit', [GreenController::class, 'edit'])
       ->name('listings.edit')
       ->middleware('auth');

    //Update Single Listing
   Route::put('/{listing}', [GreenController::class, 'update'])
       ->name('listings.update')
       ->middleware('auth');

    //Destroy Single Listing
   Route::delete('/{listing}', [GreenController::class, 'destroy'])
       ->name('listings.destroy')
       ->middleware('auth');

   //Store Single Listing
   Route::post('', [GreenController::class, 'store'])
       ->name('listings.store')
       ->middleware('auth');
});

//User routes
Route::prefix('user')->group(function (){

    //Show Register/Create User
   Route::get('/register', [UserController::class, 'create'])
       ->name('user.create')
       ->middleware('guest');

   //Store User
   Route::post('', [UserController::class, 'store'])
       ->name('user.store')
       ->middleware('guest');

   //Logout User
   Route::post('/logout', [UserController::class, 'logout'])
       ->name('user.logout')
       ->middleware('auth');

   //Show Login User Form
   Route::get('/login', [UserController::class, 'login'])
       ->name('user.login')
       ->middleware('guest');

   //Login User
   Route::post('/authenticate', [UserController::class, 'authenticate'])
       ->name('user.authenticate')
       ->middleware('guest');
});

