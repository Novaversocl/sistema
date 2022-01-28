<?php

use Illuminate\Support\Facades\Route;
//la ruta para acceder por clases sin route
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
/*

Route::get('/cliente', function () {
     cliente arriba es la ruta la carpeta  
    return view('cliente.index');
     luego la carpeta+el metodo  
});
// carpeta + metodo                   +controlador+class+metodo
Route::get('/cliente/create',[ClienteController::class,'create']);
 Mediante clases  

 */

 // para acceder de forma automática a todo aumenta con el comando php artisan route:list

//por defecto para registrar
//*************************************************/
//Route::resource('cliente',ClienteController::class)
//Auth::routes();
//*************************************************/

// de sta forma quedan bloqueado el acceso  sin iniciar la cuenta.
 Route::resource('cliente',ClienteController::class)->middleware('auth');
//para desaparecer el register en el login
Auth::routes(['register'=>false,'reset'=>false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// es donde se direja directo al controlador index
Route::get('/', [ClienteController::class, 'index'])->name('home');  


Route::group(['middleware'=>'auth'],function () {
Route::get('/', [ClienteController::class, 'index'])->name('home');  
});