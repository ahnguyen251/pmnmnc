<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',function(){
    return view('hello');
});

// Route::get('/product',function(){
//     return view('product.index');
// });

Route::get('/product/{id}',function(string $id){
    return"ID:".$id ;
});
Route::get('/product/{id?}',function(?string $id="anhngoc"){
    return"ID:".$id ;
});
Route::get('/test',function(){
    return response() -> json("hello World");
});

Route::get('/product/add',function(){
    return view('product.add');
})->name('add');

Route::get('/product/$id}',function($id){
    return view('product.detail',['id'=>$id]);
});

Route::prefix('product')->group(function(){
    Route::get('/',function(){
     return view('product.index');
    });

    Route::get('/add',function(){
        return view('product.add');
    })->name('add');

    Route.get('/id}',function($id){
        return view('product.detail', ['id' => $id]);
    });
});

Route::fallback function(){
    return view('error.404')
}