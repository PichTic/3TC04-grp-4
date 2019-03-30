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

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::view('/botman/chat', 'chatbotFrame');


Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/questions', 'QuestionsController@questionStore')->name('questions.store');
    Route::get('/answer/{id}', 'AnswersController@questions')->name('answer');
    Route::post('/answer/{id}', 'AnswersController@questionsAdd')->name('questions.add');
    Route::get('/question/{id}', 'QuestionsController@answer')->name('question.answer');

    Route::post('/question/{id}', 'QuestionsController@answerStore')->name('answer.store');
    Route::put('/question/{id}', 'QuestionsController@edit')->name('question.edit');
    Route::put('/question/{id}/associate', 'QuestionsController@associate')->name('question.associate');


    Route::delete('/question/{id}', 'QuestionsController@answerDelete')->name('answer.delete');
});
