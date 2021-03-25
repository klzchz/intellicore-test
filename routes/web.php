<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RatingController;
//use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('companies/{company}/rate', [RatingController::class,'store'])
    ->name('company.name');

Route::resource('companies', CompanyController::class);

Route::get('/', function () {
    return Inertia::render('HomePage/HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'maxRating' => config('app.maxRating')
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');



