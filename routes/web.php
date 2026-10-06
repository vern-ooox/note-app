<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', [NoteController::class, 'index']);
Route::get('/notes/create', [NoteController::class, 'create']);
Route::post('/notes', [NoteController::class, 'store']);
Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
Route::get('/notes/{note}/edit', [NoteController::class, 'edit']);
Route::put('/notes/{note}', [NoteController::class, 'update']);
Route::patch('/notes/{note}/toggle', [NoteController::class, 'toggle']);
