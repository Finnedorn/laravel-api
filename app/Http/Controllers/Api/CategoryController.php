<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with(['projects'])->get();
        return response()->json([
            'success' => true,
            'results' => $categories
        ]);

    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with(['projects'])->first();
        return response()->json([
            'success' => true,
            'results' => $category
        ]);
    }
}
