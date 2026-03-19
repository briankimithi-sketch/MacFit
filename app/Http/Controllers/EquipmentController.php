<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function createEquipment(Request $request) {
        $validated = $request->validate([
            'name'=>'required|string',
            'usage'=>'required|string',
            'model_no'=>'required|numeric',
            'value'=>'string',
            'status'=>'required'
        ]);

        $equipment = new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];

        try{
            $equipment->save();
            return response()->json($equipment);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save Equipment.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readAllEquipments() {
        try{
            $equipments = Equipment::all();
            return response()->json($equipments);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Equipments.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readEquipment($id) {
        try{
            $equipment = Equipment::findOrFail($id);
            return response()->json($equipment);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the equipment with ID.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function updateEquipment(Request $request, $id) {
        $validated = $request->validate([
            'name'=>'required|string',
            'usage'=>'required|string',
            'model_no'=>'required|integer',
            'value'=>'string',
            'status'=>'required'
        ]);

        try{
            $equipment = Equipment::findOrFail($id);

            $equipment->name = $validated['name'];
            $equipment->usage = $validated['usage'];
            $equipment->model_no = $validated['model_no'];
            $equipment->value = $validated['value'];
            $equipment->status = $validated['status'];

            $equipment->save();
            return response()->json($equipment);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to update the equipment.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function deleteEquipment($id) {
        try{
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return response("Equipment deleted successfully!");
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to delete the equipment.',
                'message'=>$exception->getMessage()
            ]);
        }
    }
}

