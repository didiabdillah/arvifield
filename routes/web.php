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

Route::get('/', 'ResourceController@resource')->name('resource');

// Resource
Route::group(['prefix' => 'resource'], function () {
    Route::get('/', 'ResourceController@resource')->name('resource');

    Route::group(['prefix' => 'create'], function () {
        Route::get('/', 'ResourceController@create')->name('resource_create');
        Route::post('/get/tag', 'ResourceController@create_get_tag')->name('resource_create_get_tag');
    });
    Route::post('/store', 'ResourceController@store')->name('resource_store');
    Route::get('/{id}/edit', 'ResourceController@edit')->name('resource_edit');
    Route::patch('/{id}/update', 'ResourceController@update')->name('resource_update');
    Route::delete('/{id}/destroy', 'ResourceController@destroy')->name('resource_destroy');
});

// Source
Route::group(['prefix' => 'source'], function () {
    Route::get('/', 'SourceController@index')->name('source');
    Route::get('/create', 'SourceController@create')->name('source_create');
    Route::post('/store', 'SourceController@store')->name('source_store');
    Route::get('/{id}/edit', 'SourceController@edit')->name('source_edit');
    Route::patch('/{id}/update', 'SourceController@update')->name('source_update');
    Route::delete('/{id}/destroy', 'SourceController@destroy')->name('source_destroy');
});

// Category
Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'CategoryController@category')->name('category');
    Route::get('/create', 'CategoryController@create')->name('category_create');
    Route::post('/store', 'CategoryController@store')->name('category_store');
    Route::get('/{id}/edit', 'CategoryController@edit')->name('category_edit');
    Route::patch('/{id}/update', 'CategoryController@update')->name('category_update');
    Route::delete('/{id}/destroy', 'CategoryController@destroy')->name('category_destroy');
});

// Route::get('/', function () {
//     return view('welcome');
// });
