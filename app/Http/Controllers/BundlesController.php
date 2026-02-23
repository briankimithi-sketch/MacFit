<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bundles;
class BundlesController extends Controller
{
     public function createbundle(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required|date',
            'duration' => 'required|time',
            'description' =>'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id'
        ]);
        $bundle = new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['start_time'];
        $bundle->duration = $validated['duration'];
        $bundle->description = $validated['description'];
        $bundle->category_id = $validated['category_id'];

        try {
            $bundle->save();
            return response()->json($bundle);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save bundle',
                 'message' => $exception->getMessage()
                 ]);
        }
    }
    public function readAllBundles(){
        try{
            // $bundles = Bundle::all();
            $bundles = Bundles::join('categories', 'categories.id', '=', 'bundles.category_id')
                ->select('bundles.*', 'categories.name as category_name');
            return response()->json($bundles->get());
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch bundles',
                 'message' => $exception->getMessage()
                 ]);
        }
    }    
    public function readBundle($id){
        try{
            // $bundle = Bundle::findOrFail($id);
             $bundle = Bundles::join('categories', 'categories.id', '=', 'bundles.category_id')
                ->select('bundles.*', 'categories.name as category_name')
                ->where('bundles.id', $id)
                ->first();
            $bundle = Bundle::findOrFail($id);
            return response()->json($bundle);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch bundle with id ' . $id,
                    'message' => $exception->getMessage()
                ]);
        }
    }
    public function updateBundle(Request $request, $id){
          $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required|date',
            'duration' => 'required|time',
            'description' =>'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id'
        ]);
       
        try{
           $bundle = Bundle::findOrFail($id);
           $bundle->name = $validated['name'];
           $bundle->start_time = $validated['start_time'];
           $bundle->duration = $validated['duration'];
           $bundle->description = $validated['description'];
           $bundle->category_id = $validated['category_id'];
           $bundle->description = $validated['description'];
           $bundle->save();
           return response()->json($bundle);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to update bundle with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
       
    }
    public function deleteBundle($id){
        try{
            $bundle = Bundle::findOrFail($id);
            $bundle->delete();
            return response()->json(['message' => 'Bundle deleted successfully']);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete bundle with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
    }
}


