<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\SubscriptionController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Roles
    Route::post('/saveRole', [RoleController::class, 'createrole']);
    Route::get('/getRoles', [RoleController::class, 'readAllRoles']);
    Route::get('/getRole/{id}', [RoleController::class, 'readRole']);
    Route::post('/updateRole/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/deleteRole/{id}', [RoleController::class, 'deleteRole']);

    // Categories
    Route::post('/saveCategory', [CategoryController::class, 'createcategory']);
    Route::get('/getCategories', [CategoryController::class, 'readAllCategories']);
    Route::get('/getCategory/{id}', [CategoryController::class, 'readCategory']);
    Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

    // Gyms
    Route::post('/saveGym', [BundleController::class, 'createGym']);
    Route::get('/getGym', [BundleController::class, 'readAllGyms']);
    Route::get('/getGym/{id}', [BundleController::class, 'readGym']);
    Route::post('/updateGym/{id}', [BundleController::class, 'updateGym']);
    Route::delete('/deleteGym/{id}', [BundleController::class, 'deleteGym']);

    // Bundles
    Route::post('/saveBundle', [BundleController::class, 'createBundle']);
    Route::get('/getBundles', [BundleController::class, 'readAllBundles']);
    Route::get('/getBundle/{id}', [BundleController::class, 'readBundle']);
    Route::post('/updateBundle/{id}', [BundleController::class, 'updateBundle']);
    Route::delete('/deleteBundle/{id}', [BundleController::class, 'deleteBundle']);

    // Equipment
    Route::post('/saveEquipment', [EquipmentController::class, 'createEquipment']);
    Route::get('/getEquipments', [EquipmentController::class, 'readAllEquipments']);
    Route::get('/getEquipment/{id}', [EquipmentController::class, 'readEquipment']);
    Route::post('/updateEquipment/{id}', [EquipmentController::class, 'updateEquipment']);
    Route::delete('/deleteEquipment/{id}', [EquipmentController::class, 'deleteEquipment']);

    // Subscriptions
    Route::post('/saveSubscription', [SubscriptionController::class, 'createSubscription']);
    Route::get('/getSubscriptions', [SubscriptionController::class, 'readAllSubscriptions']);
    Route::get('/getSubscription/{id}', [SubscriptionController::class, 'readSubscription']);
    Route::post('/updateSubscription/{id}', [SubscriptionController::class, 'updateSubscription']);
    Route::delete('/deleteSubscription/{id}', [SubscriptionController::class, 'deleteSubscription']);
});
