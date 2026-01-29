<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');

})->middleware('checkAge');
// Route::get('/',function(){
//     return view('hello');
// });
// Route::get('/',function(){
//     return view('hello');
// });

// Route::get('/product',function(){
//     return view('product.index');
// });

// Route::get('/product/{id}',function(string $id){
//     return"ID:".$id ;
// });
// Route::get('/product/{id?}',function(?string $id="anhngoc"){
//     return"ID:".$id ;
// });
// Route::get('/test',function(){
//     return response() -> json("hello World");
// });
// Route::get('/product', function () {
//     return view('product.index');
// })->name('product.index');

// Route::get('/product/add',function(){
//     return view('product.add');
// })->name('add');
// Route::get('/product/{id}',function(string $id){
//     return"ID:".$id ;
// });
// Route::get('/product/{id?}',function(?string $id="anhngoc"){
//     return"ID:".$id ;
// });
// Route::get('/test',function(){
//     return response() -> json("hello World");
// });
// Route::get('/product', function () {
//     return view('product.index');
// })->name('product.index');

// Route::get('/product/add',function(){
//     return view('product.add');
// })->name('add');

// Route::get('/product/$id}',function($id){
//     return view('product.detail',['id'=>$id]);
// });
// Route::get('/product/$id}',function($id){
//     return view('product.detail',['id'=>$id]);
// });

// Route::prefix('product')->name('product.')->group(function () {
//     // Route::get('/', [ProductController::class, "index"]);
//     // Route::get('/add', function () {
//     //     return view('product.add');
//     // })->name('add');
//     // // Route::get('/{id?}', function (?string $id = "123") {
//     // //     return view('product.detail', ['id' => $id]);
//     // // })->name('detail');
//     // Route::get('/detail/{id?}',[ProductController::class,'getDetail'])->name('detail');
// });

Route::prefix('product')
->middleware('checkAge')
->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('product');
        Route::get('/add', 'add')->name('add');
        Route::get('/detail/{id?}', 'getDetail')->name('detail');
        Route::post('/store', 'store');
    });
}); 
Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/checkLogin', 'checkLogin')->name('checkLogin');
        Route::get('/inputAge', 'inputAge')->name('inputAge');
        Route::post('/checkAge', 'checkAge')->name('checkAge');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/signIn', 'signIn')->name('signIn');
        Route::post('/checkSignIn', 'checkSignIn')->name('checkSignIn');
    });
});


Route::fallback(function () {
    return view('error.404');
})->name('error.404');

Route::get('/sinhvien/{name?}/{mssv?}', function (?string $name = "Luong Xuan Hieu", ?string $mssv = "123456") {
    return view('sinhvien', ['name' => $name, 'mssv' => $mssv]);
});

Route::get('/banco/{n?}', function (?int $n = 8) {
    return view('banco', ['n' => $n]);
});