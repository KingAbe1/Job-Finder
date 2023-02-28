<?php

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

Route::get('/', function () {
    return view('listing', [
        'heading' => 'Latest Job Listing',
        'job_list' => Listing::all()
    ]);
});

Route::get('/search_job/{id}', function ($id) {
    return view('search_job',[
        'result' => Listing::find($id)
    ]);
});