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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/modify_despedida','IntentsController@modify_despedida')->name('intents.modify_despedida');
Route::get('/nlu_index','IntentsController@nlu_index')->name('intents.nlu_index');
Route::get('/qna_index','QnaController@index')->name('qna.index');
Route::get('/nlu_edit{id}', 'IntentsController@nlu_edit')->name('intents.nlu_edit');
Route::get('/qna_edit{id}', 'QnAController@edit')->name('qna.edit');
Route::put('/actualizarnlu{nlu_question}','IntentsController@nlu_update')->name('intents.nlu_update');
Route::put('/actualizarqna{nlu_question}','QnAController@update')->name('qna.update');


