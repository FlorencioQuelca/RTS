<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


Route::post('login', [App\Http\Controllers\UserController::class, 'login']);
Route::get('verificarComunicacion', [\App\Http\Controllers\ActivityController::class,'verificarComunicacion']);
Route::group(['middleware'=>"auth:sanctum"],function (){

    Route::apiResource('/users', App\Http\Controllers\UserController::class);
    Route::apiResource('/permisos',\App\Http\Controllers\PermisoController::class);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
  
    Route::put('/pass/{user}',[\App\Http\Controllers\UserController::class,'pass']);
  
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout'])->name('logout'); //ok
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']); //ok
    Route::put('updatePassword/{user}', [\App\Http\Controllers\UserController::class, 'updatePassword']); //ok
    Route::put('cambioestado/{user}', [\App\Http\Controllers\UserController::class, 'cambioestado']); //ok
    
    
    Route::get('userid/{user}',[\App\Http\Controllers\UserController::class,'userid'])->name('userid');
    Route::get('/userci/{id}',[\App\Http\Controllers\UserController::class,'userci'])->name('userci');
    
    Route::get('usersadmin',[\App\Http\Controllers\UserController::class,'usersadmin'])->name('usersadmin'); //ok
    
    Route::apiResource('departamentos',\App\Http\Controllers\DepartamentoController::class); //CRUD de departamentos;
    Route::apiResource('proyectos',\App\Http\Controllers\ProyectoController::class); 
    Route::get('proyectosactivos',[\App\Http\Controllers\ProyectoController::class,'proyectosactivos'])->name('proyectosactivos'); //ok
    Route::apiResource('pedidos',\App\Http\Controllers\PedidoController::class); 
    Route::put('pedidoedit/{pedido}', [\App\Http\Controllers\PedidoController::class, 'pedidoedit'])->name('pedidoedit'); //ok
    Route::apiResource('detalle',\App\Http\Controllers\DetalleController::class); 
    Route::apiResource('fotos',\App\Http\Controllers\FotoController::class); 
    Route::apiResource('deposito',\App\Http\Controllers\DepositoController::class); 
    Route::post('upload',[\App\Http\Controllers\DepositoController::class,'upload']);

    //detalle
    Route::get('/pedidoid/{pedido}',[\App\Http\Controllers\PedidoController::class,'pedidoid'])->name('pedidoid'); //un solo pedido con su detalle

});