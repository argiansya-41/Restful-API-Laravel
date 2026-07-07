<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanenController;

Route::get('/', function () {
    return redirect('/data-panen');
});

Route::get('/data-panen', [PanenController::class, 'index']);
// Route untuk memproses data dari form
Route::post('/data-panen', [PanenController::class, 'store']);
