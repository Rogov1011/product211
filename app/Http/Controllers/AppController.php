<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class AppController extends Controller
{
    public function changeLocale(Request $request)
    {

        $request->session()->put('lang', $request->lang);
        return back();
    }
    public function mainIndex()
    {
        $products = Product::paginate(12);
        if (isset($_GET['search'])) {
            $products = Product::where("title", 'LIKE', "%" . $_GET['search'] . "%")->get();
        }
        return view("main", [
            "products" => $products,
            "categories" => Category::all()->sortBy('name')
        ]);
    }
    public function show($productSlug)
    {
        return view("products.show-product", [
            "product" => Product::where("slug", $productSlug)->first()
        ]);
    }

    public function getProductsByCategories(Category $category)
    {
        return view("catalog", [
            'products' => $category->products,
            'category' => $category
        ]);
    }
}
