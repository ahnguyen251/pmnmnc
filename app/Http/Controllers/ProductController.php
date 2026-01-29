<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProductController extends Controller 
{

    public function index()
    {
        $tittle = "Danh sách sản phẩm";
        return view('product.index',["title" => $tittle,
        'products'=> [
            ['id' => 1, 'name' => 'Sản phẩm 1', 'price' => 100000],
            ['id' => 2, 'name' => 'Sản phẩm 2', 'price' => 200000],
            ['id' => 3, 'name' => 'Sản phẩm 3', 'price' => 300000],
            ['id' => 4, 'name' => 'Sản phẩm 4', 'price' => 400000],
            ['id' => 5, 'name' => 'Sản phẩm 5', 'price' => 500000],
        ]
        ]);
    }
    public function getDetail(string $id ='123')
    {
        return view('product.detail', ['id' => $id]);
    }
}