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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{provider}/auth', ['uses' => 'SocialsController@social', 'as' => 'social.auth']);

Route::get('/{provider}/redirect', ['uses' => 'SocialsController@callback', 'as' => 'social.callback']);

Route::get('discussions/create', 'DiscussionController@create')->name('discussions.create');

Route::get('discussions', 'DiscussionController@index')->name('discussions');

Route::get('discussions/{discussion}', 'DiscussionController@show')->name('discussions.show');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('channels', 'ChannelsController');

    Route::post('discussions/store', 'DiscussionController@store')->name('discussions.store');

    Route::get('discussions/{discussion}/edit', 'DiscussionController@edit')->name('discussions.edit');

    Route::put('discussions/{discussion}/update', 'DiscussionController@update')->name('discussions.update');

    Route::post('discussions/replies/{disccussion}', 'RepliesController@store')->name('replies.store');

    Route::get('discussions/replies/like/{reply}', 'RepliesController@like')->name('likes.store');

    Route::get('discussions/replies/unlike/{reply}', 'RepliesController@unlike')->name('unlike');

    Route::get('discussions/marked-as-best-reply/{discussion}', 'RepliesController@bestReply')->name('best-reply');

    Route::get('discussions/replies/{reply}/edit', 'RepliesController@edit')->name('replies.edit');

    Route::put('discussions/replies/{reply}/update', 'RepliesController@update')->name('replies.update');

    Route::get('discussions/watch/{discussion}', 'DiscussionController@watch')->name('discussions.watch');

    Route::get('discussions/unwatch/{discussion}', 'DiscussionController@unwatch')->name('discussions.unwatch');

});
