<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/cadastro', [UsuarioController::class, 'cadastro']);
Route::post('/login', [UsuarioController::class, 'login']);
Route::middleware('auth:sanctum')->get('/usuario', [UsuarioController::class, 'usuario']);
Route::middleware('auth:sanctum')->put('/perfil', [UsuarioController::class, 'perfil']);
