<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\brandcontroller;
use App\Http\Controllers\admin\categorycontroller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\front\Ordercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::get("/categories", [categorycontroller::class, "index"]);
Route::get("/brands", [brandcontroller::class, "index"]);
Route::get("/products", [ProductController::class, "index"]);
Route::get("/featured", [ProductController::class, "featured"]);
Route::get("/customer/products", [ProductController::class, "getproduct"]);
Route::get("/brands/{id}", [brandcontroller::class, "show"]);
Route::get("/brands", [brandcontroller::class, "getbrand"]);
Route::get("/products/{id}", [ProductController::class, "getsingleproduct"]);









Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post("/category", [categorycontroller::class, "stor"]);
    Route::get("/category", [categorycontroller::class, "index"]);
    Route::put("/category/{id}", [categorycontroller::class, "update"]);
    Route::delete("/category/{id}", [categorycontroller::class, "delete"]);
    Route::get("/category/{id}", [categorycontroller::class, "show"]);

    Route::post("/brand", [brandcontroller::class, "stor"]);
    Route::get("/brand", [brandcontroller::class, "index"]);
    Route::put("/brand/{id}", [brandcontroller::class, "update"]);
    Route::get("/brand/{id}", [brandcontroller::class, "show"]);
    Route::delete("/brand/{id}", [brandcontroller::class, "delete"]);

    Route::get("/product", [ProductController::class, "index"]);
    Route::post("/product", [ProductController::class, "store"]);
    Route::get("/product/{id}", [ProductController::class, "getsingleproduct"]);
    Route::put("/product/{id}", [ProductController::class, "update"]);
    Route::delete("/product/{id}", [ProductController::class, "delete"]);
});
