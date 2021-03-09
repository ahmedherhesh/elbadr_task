<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homePage(Request $request){
        if(isset($request->q)){
            $request->validate([
                'q'=>'required|string',
            ]);
            $items = DB::table('items')->join('categories','categories.id','items.cat_id')
                                       ->where('item_name','like','%'. $request->q .'%')
                                       ->orWhere('tags','like','%'. $request->q .'%')
                                       ->orWhere('description','like','%'. $request->q .'%')
                                       ->orWhere('category_name','like','%'. $request->q .'%')
                                       ->get();
        }else{
            
            $items = DB::table('items')->orderBy('id','desc')->get();
        }
        return view('home',compact('items'));
    }

}
