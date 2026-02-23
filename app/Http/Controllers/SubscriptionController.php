<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request) {
        $validated = $request->validate([
            'user_id'=>' integer|exists:users,id',
            'bundles_id'=>'integer|exists:bundles,id',
        ]);

        $subscription = new Subscription();
        $subscription->user_id = $validated['user_id'];
        $subscription->bundles_id = $validated['bundles_id'];

        try{
            $subscription->save();
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save Subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readAllSubscriptions() {
        try{
            $subscriptions = Subscription::all();
            return response()->json($subscriptions);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Subscriptions.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readSubscription($id) {
        try{
            $subscription = Subscription::findOrFail($id);
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the subscription with ID.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function updateSubscription(Request $request, $id) {
        $validated = $request->validate([
            'user_id'=>' integer|exists:users,id',
            'bundles_id'=>'integer|exists:bundles,id',
        ]);

        try{
            $subscription = Subscription::findOrFail($id);

            $subscription->user_id = $validated['user_id'];
            $subscription->bundles_id = $validated['bundles_id'];
            
            $subscription->save();
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to update the subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function deleteSubscription($id) {
        try{
            $subscription = Subscription::findOrFail($id);
            $subscription->delete();
            return response("Subscription deleted successfully!");
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to delete the subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
