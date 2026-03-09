<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_delete', 0);

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = Category::where('is_delete', 0)->get();

        return view("admin.product.index", [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_delete', 0)->get();
        return view("admin.product.add", [
            'categories' => $categories,
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pricture'), $fileName);
            $data['image'] = 'pricture/' . $fileName;
        }

        Product::create($data);
        return redirect()->route("product");
    }

  
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::where('is_delete', 0)->get();
        return view("admin.product.edit", [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }

 
        if ($request->hasFile('image')) {
 
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pricture'), $fileName);
            $data['image'] = 'pricture/' . $fileName;
        } else {
            unset($data['image']);
        }

        $product->update($data);
        return redirect()->route("product");
    }

   
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->is_delete = 1;
        $product->save();
        return redirect()->route("product");
    }

   
    public function active(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->is_active = !$product->is_active;
        $product->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $product->is_active,
            ]);
        }

        return redirect()->route("product");
    }
}