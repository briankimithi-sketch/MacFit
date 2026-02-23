<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function createcategory(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' =>'nullable|string|max:1000'
        ]);
        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];

        try {
            $category->save();
            return response()->json($category);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save category',
                 'message' => $exception->getMessage()
                 ]);
        }
    }
    public function readAllCategories(){
        try{
            $categories = Category::all();
            return response()->json($categories);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch categories',
                 'message' => $e->getMessage()
                 ]);
        }
    }    
    public function readCategory($id){
        try{
            $category = Category::findOrFail($id);
            return response()->json($category);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch category with id ',
                    'message' => $e->getMessage()
                ]);
        }
    }
    public function updateCategory(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
            'description' =>'nullable|string|max:1000'
        ]);
       
        try{
           $existingCategory = Category::findOrFail($id);
           $existingCategory->name = $validated['name'];
           $existingCategory->description = $validated['description'];
           $existingCategory->save();
           return response()->json($existingCategory);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to update category with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
       
    }
    public function deleteCategory($id){
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete category with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
    }
    }


