<?php

use App\Http\Controllers\QRController;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Route;

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

Route::get('/qr-code', [QRController::class, "getQrCode"]);

//Route::get('/queue', [ ProcessPodcast::class])->name("save");

