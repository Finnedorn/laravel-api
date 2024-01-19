<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // solo l'admin puo cambiare le categorie quindi:
        $currentUserId = Auth::id();
        if($currentUserId != 1){
            abort(403);
        }
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        $formData = $request->validated();
        $slug = Str::slug($formData['name'],'-');
        $formData['slug'] = $slug;
        $newCategory = Category::create($formData);
        return redirect()->route('admin.categories.show', $newCategory->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $formData = $request->validated();
        $slug = Str::slug($formData['name'],'-');
        $formData['slug'] = $slug;
        $category->update($formData);
        return redirect()->route('admin.categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $currentUserId = Auth::id();
        if($currentUserId != 1){
            abort(403);
        }
        $category->delete();
        return to_route('admin.categories.index')->with('message', "l'elemento $category->name è stato eliminato con successo");
    }
}
