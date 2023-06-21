<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view("products.products_list", [
            'products'=>Product::all()
        ]);
    }

    public function create(){
        return view("products.create-product", [
            'categories'=>Category::all()->sortBy("name"),
            'conditions'=>Condition::all()->sortBy("name")
        ]);
    }

    public function store(Request $request){
        $request->validate([
            "title"=>['required', "min:3", "max:255"],
            "category"=>['required'],

        ]);

        $product = Product::add($request->all());
        $product->uploadImage($request->file("image"));
        $product->conditions()->attach($request->input("conditions"));
        return redirect()->route("products.index");
    }

    public function edit($productId){
        return view("products.edit-product", [
            'categories' => Category::all()->sortBy("name"),
            'product' => Product::find($productId),
            'conditions'=>Condition::all()->sortBy("name")
        ]);
    }

    public function update(Request $request, $productId){
        $request->validate([
            "title"=>'required|min:3|max:255',
            "category"=>'required',
        ]);

         $product = Product::find($productId);
         $product -> update([
            "title"=>$request->input('title'),
            "content"=>$request->input('text'),
            "category_id"=>$request->input('category'),
            "availability"=>$request->input('availability'),
         ]);
         $product->conditions()->sync($request->input("conditions"));
         $product->uploadImage($request->file("image"));
         return redirect()->route("products.index")->with('success', 'товар успешно обновлён!!!');
    }

    public function delete($productId){
        Product::find($productId)->remove();
        return back();
    }


    public function removeImage($productId){
        Product::find($productId)->removeImage();
        return back();
    }


}
