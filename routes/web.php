<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/2749/248/0302/4421',[BuyController::class, 'index'])->name('buy.run');
Route::post('/2749/248/0302/4421/7799',[BuyController::class, 'buy'])->name('buy.run.start');

