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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('jawab-survey/{id}', 'SurveyC@index')->name('survey');
    Route::post('simpan-jawaban',    'SurveyC@jawab')->name('survey.jawab');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', 'Admin\\HomeC@index')->name('admin.home');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/',             'Admin\\KategoriC@index'    )->name('kategori');
        Route::get('data',          'Admin\\KategoriC@data'     )->name('kategori.data');
        Route::get('add',           'Admin\\KategoriC@add'      )->name('kategori.add');
        Route::post('store',        'Admin\\KategoriC@store'    )->name('kategori.store');
        Route::get('edit/{id}',     'Admin\\KategoriC@add'      )->name('kategori.edit');
        Route::get('delete/{id}',   'Admin\\KategoriC@add'      )->name('kategori.delete');
    });

    Route::group(['prefix' => 'options'], function() {
        Route::get('/',             'Admin\\OptionC@index'      )->name('options');
        Route::get('/data',         'Admin\\OptionC@data'       )->name('options.data');
        Route::get('/add',          'Admin\\OptionC@add'        )->name('options.add');
        Route::post('/store',       'Admin\\OptionC@store'      )->name('options.store');
        Route::get('/edit/{id}',    'Admin\\OptionsC@edit'      )->name('options.edit');
    });

    Route::group(['prefix' => 'pertanyaan'], function () {
        Route::get('/',                         'Admin\\PertanyaanC@index'          )->name('pertanyaan');
        Route::get('/tambah',                   'Admin\\PertanyaanC@add'            )->name('pertanyaan.add');
        Route::get('/tambah-pertanyaan/{id}',   'Admin\\PertanyaanC@addQuestion'    )->name('pertanyaan.add-single');
        Route::post('simpan',                   'Admin\\PertanyaanC@store'          )->name('pertanyaan.store');
    });

    Route::group(['prefix'=> 'kuisioner'], function() {
       Route::get('/',                          'Admin\\QuestionnaireC@index'       )->name('kuisioner');
       Route::get('/assign/{id}',               'Admin\\QuestionnaireC@assign'      )->name('kuisioner.assign');
       Route::post('/assign/simpan',            'Admin\\QuestionnaireC@assignStore' )->name('kuisioner.simpan');

       Route::get('download/{id}',              'Admin\\QuestionnaireC@downloadPDF' )->name('kuisioner.download');
    });
});