<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

//Shows all job listing
Route::get('/', [ListingController::class,'index']);

//Shows job post form
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

//Store job post form
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');

//Show edit job post form
Route::get('/listings/edit/{id}',[ListingController::class,'edit'])->middleware('auth');

//Update edit job post
Route::put('/listings/edit/{id}',[ListingController::class,'update'])->middleware('auth');

//Delete job post
Route::delete('/listings/delete/{id}',[ListingController::class,'destroy'])->middleware('auth');

//Show registration form page
Route::get('/register',[UserController::class,'register'])->middleware('guest');

//Create new user
Route::post('/users',[UserController::class,'store']);

//Logging out user
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//Show login form
Route::get('login',[UserController::class,'login'])->middleware('guest')->name('login');

//Login users
Route::post('/users/authenticate',[UserController::class,'authenticate']);

//Show manage listing page
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

//Shows single job post
Route::get('/listings/{id}',[ListingController::class,'show']);