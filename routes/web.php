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


Route::get('', "IndexController@index")
    ->name('layouts.index');

Route::get('admin', function () {
    return view('layouts.admin');
})->name('layouts.admin');

Route::get('bucket', "IndexController@indexBucket")
  ->name('layouts.bucket');

Route::get('bucket/confirm', "IndexController@orderConfirmation")
    ->name('layouts.orderConfirm');

Route::get('filters', "IndexController@indexFilters")
    ->name('layouts.filters');

Route::get('bucket/{id}/remove', "IndexController@deleteFromBucket")->name('layouts.deleteFromBucket');

Route::get('error', function () {
    return view('layouts.error');
})->name('layouts.error');

Route::get('items/{id}', "IndexController@showItem")->name('layouts.showItem');

Route::get('items/{id}/add', "IndexController@addToBucket")->name('layouts.AddToBucket')->middleware('auth');


Route::get('{id}/feed', "IndexController@getFeedDevice")
        ->name('layouts.feed');

Route::get('news', "IndexController@newsIndex")
    ->name('layouts.newsIndex');

Route::group(['prefix' => 'devices'], function () {

    $controller = 'DevicesController';

    Route::get('', "$controller@index")
         ->name('devices.index');

    Route::get('create', "$controller@create")
         ->name('devices.create');
    Route::post('', "$controller@store")
         ->name('devices.store');

    Route::get('edit/{id}', "$controller@edit")
         ->name('devices.edit');
    Route::put('update/{id}', "$controller@update")
         ->name('devices.update');

    Route::get('delete/{id}', "$controller@delete")
         ->name('devices.delete');
    Route::delete('destroy/{id}', "$controller@destroy")
         ->name('devices.destroy');
});

Route::group(['prefix' => 'images'], function () {
    $controller = 'ImageController';
    Route::get('', "$controller@index")->name('images.index');
    Route::get('{id}', "$controller@show")->name('images.show')->where('id', '\d+');
    Route::get('add', "$controller@add")->name('images.add');
    Route::post('', "$controller@create")->name('images.create');
    Route::get('{id}/remove', "$controller@remove")->name('images.remove');
    Route::delete('{id}', "$controller@destroy")->name('images.destroy')->where('id','\d+');
});

//Components
Route::group(['prefix' => 'companies'], function () {

    $controller = 'CompaniesController';

    Route::get('', "$controller@index")
        ->name('companies.index');

    Route::get('create', "$controller@create")
        ->name('companies.create');
    Route::post('store', "$controller@store")
        ->name('companies.store');

    Route::get('edit/{id}', "$controller@edit")
        ->name('companies.edit');
    Route::put('update/{id}', "$controller@update")
        ->name('companies.update');

    Route::get('delete/{id}', "$controller@delete")
        ->name('companies.delete');
    Route::delete('destroy/{id}', "$controller@destroy")
        ->name('companies.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
