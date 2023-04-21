<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CategoryAll()
    {
        $category = Category::all();
        return view('admin.category.category_all' , compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CategoryAdd()
    {
      return view('admin.category.category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CategoryStore(Request $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description  = $data['description'];
        $category->status = $data['status'];
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function CategoryEdit($id)
    {
        $editCategory = Category::find($id);
        return view('admin.category.category_edit' , compact('editCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function CategoryUpdate(Request $request)
    {
        $category_id = $request->id;
        Category::find($category_id) -> update([
               'title' => $request->title,
               'description' => $request->description,
               'status' => $request->status,
               'slug' => $request->slug
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CategoryDelete($id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    
}
