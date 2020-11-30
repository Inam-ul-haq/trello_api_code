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
	return Redirect::route("bug-report/view", ['false']);
    return view('welcome');
});

Route::group(['prefix' => 'board'], function ($app) {
    $app->match(['get', 'post'], '/add', 'Trello@addBoard');
    $app->get('/view','Trello@viewBoard')->name('board/view');
    /* ---- label ---- */
    $app->match(['get', 'post'], '/label/add/{id?}', 'Trello@addLabel');
    $app->get('/label/view/{id?}','Trello@viewLabel')->name('label/view');
    /* ---- member ---- */
    $app->match(['get', 'post'], '/member/add/{id?}', 'Trello@addMember');
    $app->get('/member/view/{id?}','Trello@viewMember')->name('member/view');

});

Route::group(['prefix' => 'list'], function ($app) {
    $app->match(['get', 'post'], '/add/{id?}', 'Trello@addList');
    $app->get('/view/{id?}','Trello@viewList')->name('list/view');
});

Route::group(['prefix' => 'card'], function ($app) {
    $app->match(['get', 'post'], '/add/{id?}', 'Trello@addCard');
    $app->get('/view/{id?}','Trello@viewCard')->name('card/view');
    $app->post('/label/add/{id?}', 'Trello@addCardLabel');
    $app->post('/due-date/{cardId?}', 'Trello@addCardDueDate');
    $app->post('/assign-to/{cardId?}', 'Trello@addCardAssignTo');
});

Route::group(['prefix' => 'bug-report'], function ($app) {
    $app->match(['get', 'post'], '/add/{isAdmin}', 'Trello@addBugReport');
    $app->get('/labels/{project_id?}', 'Trello@getProjectLabel');
    $app->get('/bug-type/{project_id?}', 'Trello@getBugType');
    $app->get('/view/{isAdmin}/{id?}','Trello@viewBugReport')->name('bug-report/view');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
