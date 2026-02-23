<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createrole(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' =>'nullable|string|max:1000'
        ]);
        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'];

        try {
            $role->save();
            return response()->json($role);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save role',
                 'message' => $exception->getMessage()
                 ]);
        }
    }
    public function readAllRoles(){
        try{
            $roles = Role::all();
            return response()->json($roles);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch roles',
                 'message' => $exception->getMessage()
                 ]);
        }
    }    
    public function readRole($id){
        try{
            $role = Role::findOrFail($id);
            return response()->json($role);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to fetch role with id ' . $id,
                    'message' => $exception->getMessage()
                ]);
        }
    }
    public function updateRole(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'description' =>'nullable|string|max:1000'
        ]);
       
        try{
           $existingRole = Role::findOrFail($id);
           $existingRole->name = $validated['name'];
           $existingRole->description = $validated['description'];
           $existingRole->save();
           return response()->json($existingRole);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to update role with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
       
    }
    public function deleteRole($id){
        try{
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully']);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete role with id ' . $id,
                    'message' => $exception->getMessage()
                    ]);
        }
    }
}
