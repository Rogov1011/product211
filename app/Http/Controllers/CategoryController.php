<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriesList(){
        $categories = Category:: all();
        return view("categories.categories_list",[
            "categories"=>$categories
        ]);
    }

    public function createCategory(){
        return view("categories.create-category");
    }

    public function storeCategory(Request $request){
        Category::create($request->all());//INSERT INTO
        return redirect()->route("categoriesList");
    }

    public function editCategory($categoryId){
        $category = Category::find($categoryId);//SELECT
        return view('categories.edit-category',[
            'category' => $category
        ]);
    }

    public function updateCategory(Request $request, $categoryId){
        $category = Category::find($categoryId);
        $category -> update($request->all());//update
        return redirect()->route("categoriesList");
    }

    public function deleteCategory($categoryId){
        $category = Category::find($categoryId);
        $category->delete();//delete
        return back();
    }
}
