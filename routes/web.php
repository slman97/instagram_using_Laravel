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
use App\Mail\NewUserWelcomeMail;
Auth::routes();

Route::get('/', function () {
    return view('f/index');
});

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});
Route::group(['middleware'=>['auth']], function (){
   Route::post('favorite/{post}/add','FavoriteController@add')->name('post.favorite');
   Route::post('comment/{post}','CommentController@store')->name('comment.store');
});
    Route::group(['middleware'=>['auth','admin']],function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
        Route::get('/role-register','Admin\DashboardController@registered');
        Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');
        Route::put('/role-register-update/{id}','Admin\DashboardController@registerupdate');
        Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');

        Route::get('/abouts','Admin\AboutusController@index');
        Route::post('/save-aboutus','Admin\AboutusController@store');
        Route::get('/about-us/{id}','Admin\AboutusController@edit');
        Route::put('/aboutus-update/{id}','Admin\AboutusController@update');
        Route::delete('about-us-delete/{id}','Admin\AboutusController@delete');
//
        Route::get('/posts-reports','Admin\PostsController@showReports');

//
        Route::get('/service-category','Admin\ServiceController@index');
        Route::get('/service-create','Admin\ServiceController@create');
        Route::POST('/category-store','Admin\ServiceController@store');

        Route::get('/role','Admin\DashboardController@registere');
        Route::delete('/role-delet/{id}','Admin\DashboardController@registerdel');
        Route::get('/role-registe','Admin\DashboardController@registere');


    });


Route::delete('/comments/{id}', 'CommentssController@destroy')->name('comments.destroy');
Route::post('follow/{user}', 'FollowsController@store');
Route::post('like/{post}', 'LikesController@store');
Route::get('/home','PostsController@index');
Route::get('/explore','PostsController@explore');
Route::get('/p/create','PostsController@create');
Route::post('/p','PostsController@store');
Route::get('/p/{post}','PostsController@show');
Route::get('/p/{id}/edit','PostsController@edit')->name('posts.edit');
Route::put('/p/{id}','PostsController@update')->name('posts.update');
Route::delete('/p/{id}','PostsController@destroy')->name('posts.destroy');

Route::post('/p/{post}','PostsController@reportPost')->name('post.report');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/posts/{post}', 'ProfilesController@post');
Route::post('/posts/{post}/store','CommentssController@store');





Route::get('/messinger/{user}', 'messinger@index')->name('messinger.messinger');
Route::post('/m', 'messinger@store');



Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');