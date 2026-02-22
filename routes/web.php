<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingController;

Route::get('/', function () {
    $greetings = \App\Models\Greeting::latest()->get();
    return view('welcome', compact('greetings'));
});

Route::post('/greetings', [GreetingController::class, 'store']);
Route::get('/greetings', [GreetingController::class, 'index']);
