<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiscController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'verified'],
], function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('uploads/profile_pictures/{file_name}', [MiscController::class, 'licenseFileShow']);
});

require __DIR__.'/auth.php';
