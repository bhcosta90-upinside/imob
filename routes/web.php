<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'namespace' => 'Web',
    'as' => 'web.'
], function(){
    Route::get('/', 'WebController@home')->name('home');
    Route::get('/contato', 'WebController@contact')->name('contact');
    Route::get('/quero-alugar', 'WebController@rent')->name('rent');
    Route::get('/quero-comprar', 'WebController@buy')->name('buy');
    Route::get('/filtro', 'WebController@filter')->name('filter');
    Route::get('/imovel', 'WebController@property')->name('property');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
], function (){
    /**
     * Formulario de login
     */
    Route::get('/', 'AuthController@showLoginForm')->name('login.index');
    Route::post('/', 'AuthController@login')->name('login.do');

    /**
     * Routas protegidas
     */
    Route::group([
        "middleware" => "auth"
    ], function(){
        Route::get('/home', 'AuthController@home')->name('home');

        /**
         * Usuários
         */
        Route::get('/users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');

        /**
         * Empresas
         */
        Route::resource('companies', 'CompanyController');

        /**
         * Imóveis
         */
        Route::post('properties/image-set-cover', 'PropertyController@imageSetCover')->name('properties.imageSetCover');
        Route::delete('properties/image-remove', 'PropertyController@imageRemove')->name('properties.imageRemove');
        Route::resource('properties', 'PropertyController');

        /**
         * Contratos
         */
        Route::post('/contracts/get-data-companies', 'ContractController@getDataCompanies')->name('contracts.getDataCompanies');
        Route::post('/contracts/get-data-property', 'ContractController@getDataProperty')->name('contracts.getDataProperty');
        Route::resource('contracts', 'ContractController');
    });

    /**
     * Logout
     */
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
