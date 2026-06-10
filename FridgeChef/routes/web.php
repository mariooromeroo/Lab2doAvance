<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\MisRecetasController;
use App\Http\Controllers\FavoritoController;

Route::get('/', [InicioController::class, 'index']);
Route::get('/receta/{id}', [InicioController::class, 'show'])
    ->name('receta.detalle');

Route::resource('categorias', CategoriaController::class);
Route::get('/busqueda', [BusquedaController::class, 'index'])
    ->name('busqueda');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [LoginController::class, 'register']);

Route::get('/mis-recetas', [MisRecetasController::class, 'index'])->name('mis-recetas')->middleware('auth');
Route::post('/mis-recetas/guardar', [MisRecetasController::class, 'store'])->name('mis-recetas.store')->middleware('auth');
Route::get('/receta/{id}/editar', [MisRecetasController::class, 'edit'])->name('receta.editar')->middleware('auth');
Route::put('/receta/{id}', [MisRecetasController::class, 'update'])->name('receta.update')->middleware('auth');
Route::delete('/receta/{id}', [MisRecetasController::class, 'destroy'])->name('receta.destroy')->middleware('auth');

Route::post('/receta/{id}/comentario', [ComentarioController::class, 'store'])->name('comentario.store');
Route::delete('/comentario/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');

Route::get('/sobre-nosotros', function () {
    return view('sobre-nosotros');
})->name('sobre-nosotros');

Route::middleware('auth')->group(function () {
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos/toggle/{id_receta}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
});