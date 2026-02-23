<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymController extends Controller
{
     public function creategym(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique:gyms,name',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'description' =>'nullable|string|max:1000'
        ]);
        $gym = new Gym();
        $gym->name = $validated['name'];
        $gym->longitude = $validated['longitude'];
        $gym->latitude = $validated['latitude'];
        $gym->description = $validated['description'];

        try {
            $gym->save();
            return response()->json($gym);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save gym',
                 'message' => $exception->getMessage()
                 ]);
        }
    }
    public function readAllGyms(){
        try{
            $gyms = Gym::all();
            return response()->json($gyms);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch gyms',
                 'message' => $exception->getMessage()
                 ]);
        }
    }    
    public function readGym($id){
        try{
            $gym = Gym::findOrFail($id);
            return response()->json($gym);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch gym with id ' . $id,
                    'message' => $exception->getMessage()
                ]);
        }
    }
    public function updateGym(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|unique:gyms,name',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'description' =>'nullable|string|max:1000']);
       
        try{
           $gym = Gym::findOrFail($id);
           $gym->name = $validated['name'];
           $gym->description = $validated['description'];
           $gym->save();
           return response()->json($gym);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to update gym with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
       
    }
    public function deleteGym($id){
        try{
            $gym = Gym::findOrFail($id);
            $gym->delete();
            return response()->json(['message' => 'Gym deleted successfully']);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete gym with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
    }
}
