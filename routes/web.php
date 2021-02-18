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


Route::group(["namespace" => "Admin", "middleware" => "auth"], function () {


    Route::group(["middleware" => "active-account"], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        });

        Route::get('/transactions', function () {
            return view('admin.dashboard.index');
        })->name("transactions");

        Route::get('/inventory', "InventoryController")->name("inventory");

        Route::group(["prefix" => "users", "as" => "users."], function () {
            Route::get("/", "UserController@index")->name("index");
            Route::post("/", "UserController@store")->name("store");
            Route::get("/{user}/edit", "UserController@edit")->name("edit");
            Route::put("/{user}", "UserController@update")->name("update");
            Route::get("/create", "UserController@create")->name("create");
        });


        Route::group(["prefix" => "categories", "as" => "categories."], function () {
            Route::get("/", "CategoryController@index")->name("index");
            Route::post("/", "CategoryController@store")->name("store");
            Route::get("/{category}/edit", "CategoryController@edit")->name("edit");
            Route::put("/{category}", "CategoryController@update")->name("update");
            Route::get("/create", "CategoryController@create")->name("create");
        });



        Route::group(["prefix" => "products", "as" => "products."], function () {
            Route::get("/create", "ProductController@create")->name("create");
            Route::get("/", "ProductController@index")->name("index");
            Route::post("/", "ProductController@store")->name("store");
            Route::get("/{product}", "ProductController@show")->name("show");
            Route::get("/{product}/edit", "ProductController@edit")->name("edit");
            Route::put("/{product}", "ProductController@update")->name("update");
        });


    });

    Route::get("account", "AuthController@account")->name("account");
    Route::post("account", "AuthController@updateAccount")->name("account.update");

    Route::get("logout", "AuthController@logout")->name("logout");

});



Route::group(["namespace" => "Admin", "middleware" => "guest"], function () {
    Route::get("login", "AuthController@login")->name("login");
    Route::post("authenticate", "AuthController@authenticate")->name("authenticate");
});

