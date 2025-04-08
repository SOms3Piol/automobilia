<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();

        $vehicles = $user->vehicles()
            ->select(['id', 'thumbnail','title', 'price', 'modal', 'make', 'mileage', 'location'])
            ->get();
        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('vehicle.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $validation = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',  
        ], [
            'thumbnail.required' => 'An image is required.',
            'thumbnail.image' => 'The file must be an image.',
            'thumbnail.mimes' => 'The image must be of type jpeg, png, jpg, or gif.',
        ]);
        
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = uniqid("thumbnail_", true) . "." . $thumbnail->getClientOriginalExtension();
            $filepath = $thumbnail->storeAs('storage',$filename , 'public');  
        }
       
        Vehicle::create([
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'modal' => $request->input('model'),
            'make' => $request->input('make'),
            'description' => $request->input('description'),
            'exterior_color' => $request->input('exterior_color'),
            'interior_color' => $request->input('interior_color'),
            'year' => $request->input('year'),
            'mileage' => $request->input('mileage'),
            'transmission' => $request->input('transmission'),
            'manufacture_country' => $request->input('manufacture_country'),
            'category' => $request->input('category'),
            'phone_number' => $request->input('phone_number'),
            'engine_capacity' => $request->input('engine_capacity'),
            'engine_type' => $request->input('engine_type'),
            'location' => $request->input('location'),
            'additional_feature' => json_encode($request->input('additional_feature')),
            'thumbnail' => $filepath,
            

        ]);


        return redirect()->route('vehicle.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $vehicle = Vehicle::find($id);

        if(!$vehicle){
            abort(404,'Data not found');
        }
        $user = $vehicle->user()->select('name')->first();;
        
        return view('vehicle.show', compact('vehicle', 'user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
        return view('vehicle.edit',compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $vehicle = Vehicle::find($id);
        if(!$vehicle){
            abort(404,'Vehicle not found.');

        }

        $oldFile = $vehicle->thumbnail;
        if($request->hasFile('thumbnail')){

            
            if(file_exists($oldFile)){
                unlink($oldFile);
            }
            $thumbnail = $request->file('thumbnail');
            $filename = uniqid("thumbnail_", true) . "." . $thumbnail->getClientOriginalExtension();
            $filepath = $thumbnail->storeAs('storage',$filename , 'public'); 
            $vehicle->update([
                'thumbnail' => $filepath
            ]);
        }else{
            $vehicle->update([
                'thumbnail' => $oldFile
            ]);
        }
         

        $vehicle->update([
            'user_id' => $request->user()->id,
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'modal' => $request->input('model'),
            'make' => $request->input('make'),
            'description' => $request->input('description'),
            'exterior_color' => $request->input('exterior_color'),
            'interior_color' => $request->input('interior_color'),
            'year' => $request->input('year'),
            'mileage' => $request->input('mileage'),
            'transmission' => $request->input('transmission'),
            'manufacture_country' => $request->input('manufacture_country'),
            'category' => $request->input('category'),
            'engine_capacity' => $request->input('engine_capacity'),
            'engine_type' => $request->input('engine_type'),
            'location' => $request->input('location'),
            'additional_feature' => json_encode($request->input('additional_feature')),
            'phone_number' => $request->input('phoneNumber')
         ]);


         return redirect()->route('vehicle.index');
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $vehicle = Vehicle::find($id);
        if(!$vehicle){
            abort('404' , 'Not Found.');
        }

        unlink(storage_path('app/public/' . $vehicle->thumbnail));


        $vehicle->delete();

        return redirect()->route('vehicle.index');
    }
}
