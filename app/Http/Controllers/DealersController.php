<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PurchasedPlan;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DealersController extends Controller{
    public function index(){
        $dealers = User::all();
        $total = $dealers->count();
        
         $dealers->map(function($dealer){
            $dealer->vehicle_count = $dealer->vehicles()->count();
         });
        return view('dealer.index',compact('dealers','total'));
    }
    public function show(string $id){

        $dealer = User::find($id);
        if(!$dealer){
            abort('404' , 'User not found.');
        }
        $vehicles = $dealer->vehicles()->select(['id','title','price','make','modal','mileage','year','thumbnail'])->get();
        $total = $vehicles->count();
        return view('dealer.show' , compact("vehicles",'dealer' , 'total'));
    }
    public function index_ads(Request $request){
        $dealer  = $request->user();
        if(!$dealer){
            abort('403' , 'unauthorized');
        }
        $vehicles = $dealer->vehicles()->select(['id','title' , 'thumbnail' , 'price' , 'make' , 'modal' , 'year' , 'mileage'])->get();

        return view( 'dealer.managead' , compact('vehicles'));

    }

    public function active_ad(Request $request){
        $id = $request->input('id');

        $vehicle = Vehicle::find($id);
        if(!$vehicle){
            abort('404', 'Vehicle Not Found');
        }
        $vehicle->update([
            'active' => true
        ]);
        $purchased_plan = PurchasedPlan::where('user_id' , $request->user()->id);
        if($purchased_plan->no_of_ads < $purchased_plan->allowed_ads){
            $purchased_plan->update([
                'no_of_ads' => $purchased_plan->no_of_ads + 1
            ]);

            return redirect()->back();
        }
        
       return redirect()->back()->withErrors(['error' , 'Posting Limit Reached Upgrade Your Plan']);

    }

    public function disable_ad(Request $request){
        $id = $request->input('id');

        $vehicle = Vehicle::find($id);
        if(!$vehicle){
            abort('404', 'Vehicle Not Found');
        }
        $vehicle->update([
            'active' => false
        ]);

        $purchased_plan = PurchasedPlan::where('user_id' , $request->user()->id);
        $purchased_plan->no_of_ads = max(0 , $purchased_plan->no_of_ads - 1);
        $purchased_plan->save();

       return redirect()->back();
    }


    public function dashboard(){

        $purchased_plan = PurchasedPlan::where('user_id' , auth()->user()->id)->first();

        $user_ads = [
            'allowed' => $purchased_plan->allowed_ads,
            'active' => $purchased_plan->no_of_ads
        ];

        return view('dashboard' , compact('user_ads'));
    }
}

?>