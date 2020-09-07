<?php

namespace App\Http\Controllers;
use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

  
    public function create()
    {
        return view('categories.create');   
    }

    
    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category created succesfully');

        return redirect(route('categories.index'));
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category Updated Succesfully');

        return redirect(route('categories.index'));
    }

   
    public function destroy(Category $category)
    {
        if($category->posts->count() > 0){
            session()->flash('error', 'Category cannot be deleted it has some posts');
        }
        
        else{
            $category->delete();
            session()->flash('success', 'Category deleted succesfully');
        }

        return redirect(route('categories.index'));
    }
}
