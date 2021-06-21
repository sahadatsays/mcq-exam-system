<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sub-category.index')->with([
            'categories'        => Category::all(),
            'sub_category_list' => SubCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:sub_categories',
            'category_id'   => 'required'
        ]);
        $subCategory = SubCategory::create([
            'name'          => $request->name,
            'category_id'   => $request->category_id
        ]);

        session()->flash('action', ['type' => 'success', 'message' => 'Sub Category store succcess...']);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $sub_category)
    {
        return view('pages.sub-category.edit')->with([
            'sub_category'      => $sub_category,
            'categories'        => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $request->validate([
            'name' => 'required|string|unique:sub_categories,name,' . $sub_category->id,
            'category_id'   => 'required'
        ]);
        $sub_category->update([
            'name'          => $request->name,
            'category_id'   => $request->category_id
        ]);

        session()->flash('action', ['type' => 'success', 'message' => 'Sub Category Update succcess...']);

        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $sub_category)
    {
        if ($sub_category->delete()) {
            session()->flash('action', ['type' => 'success', 'message' => 'Sub Category delete succcess...']);
            return back();
        }
        session()->flash('action', ['type' => 'warning', 'message' => 'Sub Category does not delete...']);
        return back();
    }
    /**
     * Get sub categories by category
     *
     * @param Category $category
     * @return array
     */
    public function getSubCategoryByCategory(Category $category)
    {
        $sub_list = $category->sub_categories;

        return response(['sub_list' => $sub_list]);
    }
}
