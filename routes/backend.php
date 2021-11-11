<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'], 'namespace' => 'Backend'], function(){
    Route::post('admin-login', 'AuthController@adminLogin');
});

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Backend'], function() {
    //Dashboard
    Route::get('dashboard', 'AccountController@dashboard');
    //Account
    Route::post('account-list', 'AccountController@accountList');
    Route::post('account-fields', 'AccountController@accountFields');
    Route::post('account-store', 'AccountController@accountStore');
    Route::post('account-update', 'AccountController@accountUpdate');
    Route::post('account-delete', 'AccountController@accountDelete');
    //Banner
    Route::post('banner-list', 'BannerController@bannerList');
    Route::post('banner-fields', 'BannerController@bannerFields');
    Route::post('banner-store', 'BannerController@bannerStore');
    Route::post('banner-update', 'BannerController@bannerUpdate');
    Route::post('banner-delete', 'BannerController@bannerDelete');
    //Category
    Route::post('category-list', 'CategoryController@categoryList');
    Route::post('category-fields', 'CategoryController@categoryFields');
    Route::post('category-store', 'CategoryController@categoryStore');
    Route::post('category-update', 'CategoryController@categoryUpdate');
    Route::post('category-delete', 'CategoryController@categoryDelete');
    //Author
    Route::post('author-list', 'AuthorController@authorList');
    Route::post('author-fields', 'AuthorController@authorFields');
    Route::post('author-store', 'AuthorController@authorStore');
    Route::post('author-update', 'AuthorController@authorUpdate');
    Route::post('author-delete', 'AuthorController@authorDelete');
    //Author
    Route::post('tag-list', 'TagController@tagList');
    Route::post('tag-fields', 'TagController@tagFields');
    Route::post('tag-store', 'TagController@tagStore');
    Route::post('tag-update', 'TagController@tagUpdate');
    Route::post('tag-delete', 'TagController@tagDelete');
    //Book
    Route::post('book-list', 'BookController@bookList');
    Route::post('book-fields', 'BookController@bookFields');
    Route::post('book-store', 'BookController@bookStore');
    Route::post('book-update', 'BookController@bookUpdate');
    Route::post('book-delete', 'BookController@bookDelete');
});
