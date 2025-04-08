<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;


class SearchController extends Controller{
    public function index(){
        $vehicles = Vehicle::select(['id','title','thumbnail','mileage','make','modal','price','year'])->get();
        $total = $vehicles->count();
        return view('products',compact('vehicles','total'));
        
    }
    public function search(Request $request){

        $queryParams = $request->all();

        $query = Vehicle::query();

        foreach($queryParams as $key => $value){
            if(!empty($value)) $query->where($key, $value);
        }

        $vehicles = $query->get();
        $total = $vehicles->count();
        
        return view('search' , compact('vehicles' , 'queryParams' , 'total'));
    }
}


?>