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

// 前台
Route::get('/', 'BlogsController@index');                                                   // 首页
Route::get('blogs/detail/{id}','BlogsController@detail')->name('blog.detail');            // 博文详情
Route::get('resume','BlogsController@resume')->name('resume');

// 后台
Route::get('/home', 'HomeController@index')->name('home');                                  // 后台首页
Route::get('blogs/create','BlogsController@create')->name('blog.create');
Route::post('blogs','BlogsController@store')->name('blog.store');
Route::get('blogs/delete/{id}','BlogsController@destroy')->name('blog.destroy');
Route::get('blogs/edit/{id}','BlogsController@edit')->name('blog.edit');
Route::put('blogs/update/{id}','BlogsController@update')->name('blog.update');
Route::get('blogs/list','BlogsController@list')->name('blog.list');
Route::get('blogs/show/{id}','BlogsController@show')->name('blog.show');

Auth::routes();

Route::get('/email/verify/{token}',[
    // 路由命名可以让我们在使用route函数生成指向该路由的URL或者生成跳转到该路由的重定向链接时更加方便
    'as' => 'email.verify',                 // 以后指向该路由只需使用route('email.verify','第二个参数',...)即可
    'uses' => 'EmailController@verify'      // 使用路由命名的方法为 EmailController 里面的 verify 方法
]);

//Route::resource('blogs','BlogsController',['names' => [
//    'create' => 'blog.create',
//    'show'   => 'blog.show',
//]]);


