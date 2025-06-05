<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PurchasedPlan;
use \Stripe\Stripe;
use \Stripe\Checkout\Session;

use Illuminate\Http\Request;

class CheckoutController extends Controller{

    public function index(){
        $plans = Plan::all();
        $purchased = PurchasedPlan::where('user_id' , auth()->user()->id)->first();
        return view('checkout.plans' , compact('plans' , 'purchased'));
    }

    public function checkout_session(string $id){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $plan = Plan::find($id);
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->title,
                    ],
                    'unit_amount' => $plan->price, 
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'plan_id' => $plan->id,
                'allowed_ads' => $plan->allowed_ads
            ],
            'mode' => 'payment', 
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);


        return redirect($session->url);
    }


    public function checkout_success(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session_id = $request->get('session_id');
        $session = Session::retrieve($session_id);

        $existedPlan = PurchasedPlan::where('user_id', auth()->user()->id);

        if(!($existedPlan->plan_id == $session->metadata->plan_id)){
            $existedPlan->update([
                'plan_id' => $session->metadata->plan_id,
                'user_id' => auth()->user()->id,
                'allowed_ads' => $session->metadata->allowed_ads
            ]);
        }

        return redirect()->route('plans.index');
        
    }

    public function checkout_cancel(){
        abort('503' , 'service is not available');
    }

    public function unsubscribe(){
        $plan = PurchasedPlan::where('user_id' , auth()->user()->id);
        $plan->update([
            'plan_id' => 1,
            'allowed_ads' => 5
        ]);
    }

}


?>