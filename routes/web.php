<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', 'FirstPage@index')->middleware('auth');
Route::get('inicio', 'FirstPage@index')->name('inicio')->middleware('auth');

Route::get('usuarios', 'Users@index')->middleware('auth');
Route::get('usuarios/cadastrar', 'Users@register')->name('cadastrarUsuario')->middleware('auth');
Route::post('usuarios/registerUser', 'Users@create')->name('register')->middleware('auth');
Route::get('usuarios/detalhe/{id}', 'Users@detail')->name('detalheUsuario')->middleware('auth');
Route::put('usuarios/atualizarUsuario', 'Users@updateUser')->name('updateUser')->middleware('auth');

Route::get('funcionarios', 'EmployeesController@index')->middleware('auth');
Route::get('funcionarios/cadastrar', 'EmployeesController@register')->middleware('auth');
Route::post('funcionarios/registerEmployee', 'EmployeesController@create')->name('registerEmployee')->middleware('auth');
Route::get('funcionarios/detalhe/{id}', 'EmployeesController@detail')->middleware('auth');
Route::put('funcionarios/updateEmployee', 'EmployeesController@updateEmployee')->name('updateEmployee')->middleware('auth');

Route::get('movimentacoes', 'TransactionsController@index')->middleware('auth');
Route::get('movimentacoes/cadastrar', 'TransactionsController@register')->middleware('auth');
Route::post('movimentacoes/registerTransaction', 'TransactionsController@create')->name('registerTransaction')->middleware('auth');

Route::get('/clear-cache', function(){
  Artisan::call('cache:clear');
  return "cache is cleared";
})->middleware('auth');
