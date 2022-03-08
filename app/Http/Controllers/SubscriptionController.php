<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index(){
        return view('pages.subscription');
    }

    public function jsonSubscription(){
        $subscriptions = Subscription::all();
        return response()->json($subscriptions);
    }

    public function insertSubscription(Request $request){
        $insertSubs = new Subscription;

        $insertSubs->email = $request->email;
        $insertSubs->ip = $request->ip;

        $insertSubs->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    public function deleteSubscription(Request $request){

        $id=$request->id;
        $deleteSubs = Subscription::where('id',$id);
        $deleteSubs->delete();


        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }
}
