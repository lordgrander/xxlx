<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Start;
 

Route::get('/',[Start::class, 'index']);

Route::middleware('check_login')->group(function () {
    Route::get('/2749/248/0302/4421/{index}',[BuyController::class, 'index'])->name('buy.run');
    Route::post('/2749/248/0302/4421/7799/{gain_number}',[BuyController::class, 'buy'])->name('buy.run.start');
    Route::get('/2749/248/0302/4421/7799/778/{id}',[BuyController::class, 'bill'])->name('bill.view.success');

    Route::get('/2749/248/0302/4421',[BuyController::class, 'hightlow'])->name('buy.hight.low');
    Route::get('/2749/248/4421/0302',[BuyController::class, 'kickcool'])->name('buy.kick.cool');


    Route::get('/2749/22/54/21/4/5/6/215/2',[OrderController::class, 'index'])->name('buy.history');

});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
