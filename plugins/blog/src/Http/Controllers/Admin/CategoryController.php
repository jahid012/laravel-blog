<?php

namespace Plugins\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Plugins\Blog\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('categories.viewAny');

        $categories = Category::paginate(30);
        return view('blog::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('categories.create');

        return view('blog::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('categories.create');

        $request->validate([
            'name'          => 'required|min:2|max:255|unique:blog_categories',
            'description'   => 'nullable|min:5|max:500',
        ]);

        Category::create([
            'name'          => $request->name,
            'description'   => $request->description,
        ]);

        alert()->primary('Category Created Successfully.');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('categories.show');

        return redirect()->route('categories.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('categories.update');

        return view('blog::category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('categories.update');

        $request->validate([
            'name'          => 'required|min:2|max:255|unique:blog_categories,name,'.$category->id.',id',
            'description'   => 'nullable|min:5|max:500',
        ]);

        $data = $request->except(['_token', '_method']);
        $category->update($data);

        toastr()->primary("Category Updated Successfully");
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $this->authorize('categories.delete');

        if($category != null){
            $category->delete();
        }
        alert()->primary("Category Deleted Successfully.");
        return redirect()->route('categories.index');
    }
}
