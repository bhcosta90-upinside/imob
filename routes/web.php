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
    'prefix' => 'api',
    'namespace' => 'Web',
    'as' => 'api.'
], function(){
    Route::post('filtro', 'ApiController@filter')->name('filter');
    Route::post('search', 'ApiController@search')->name('search');
    Route::post('category', 'ApiController@category')->name('category');
    Route::post('type', 'ApiController@type')->name('type');
    Route::post('neighborhood', 'ApiController@neighborhood')->name('neighborhood');
    Route::post('bedrooms', 'ApiController@bedrooms')->name('bedrooms');
    Route::post('suites', 'ApiController@suites')->name('suites');
    Route::post('bathrooms', 'ApiController@bathrooms')->name('bathrooms');
    Route::post('garage', 'ApiController@garage')->name('garage');
    Route::post('price-base', 'ApiController@priceBase')->name('price.base');
    Route::post('price-limit', 'ApiController@priceLimit')->name('price.limit');
});
Route::group([
    'namespace' => 'Web',
    'as' => 'web.'
], function(){
    /**
     * Página inicial
     */
    Route::get('/', 'WebController@home')->name('home');

    /*
     * Página destaque
     */
    Route::get('/destaque', 'WebController@spotlight')->name('spotlight');

    /**
     * Experiencias
     */
    Route::get('/experiencias', 'WebController@experience')->name('experience');
    Route::get('/experiencias/{slug}', 'WebController@experienceCategory')->name('experience.category');

    /**
     * Contato
     */
    Route::get('/contato', 'WebController@contact')->name('contact');

    /**
     * Aluguel de imóveis
     */
    Route::get('/quero-alugar/{slug}', 'WebController@rentProperty')->name('rent.property');
    Route::get('/quero-alugar', 'WebController@rent')->name('rent');

    /**
     * Compras de imóveis
     */
    Route::get('/quero-comprar/{slug}', 'WebController@buyProperty')->name('buy.property');
    Route::get('/quero-comprar', 'WebController@buy')->name('buy');

    /**
     * Filtragem
     */
    Route::match(['get', 'post'], '/filtro', 'WebController@filter')->name('filter');

    /**
     * Página de detalhes do imóvel
     */
    Route::get('/imovel', 'WebController@property')->name('propert');
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
