<?php

use App\Http\Controllers\CekdptController;
use App\Models\DataPemilih;
use Illuminate\Support\Facades\Route;

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
    return view('welcome',[
        'data' => DataPemilih::orderBy('created_at', 'desc')->paginate(10)
    ]);
});

// cek
Route::any('/cek', [CekdptController::class, 'index'])->name('cek');