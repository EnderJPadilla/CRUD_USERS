<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

// Route::get('/', [UsuarioController::class, 'create'])->name('home');

Route::get('/', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');