<?php

use App\Http\Controllers\TextMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [TextMessageController::class, 'index']);
Route::post('/save-user', [TextMessageController::class, 'store']);