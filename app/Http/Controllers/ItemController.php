<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function addItem(){
        if(session()->has('seller')){
            $categories =  DB::table('categories')->where('parent_id','=','0')->get();

            return view('add-item',compact('categories'));
        }else{
            return redirect('/');
        }
    }
    public function addItemPost(Request $request){
        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:4',
            'categories' => 'required|int',
            'sub_categories' => 'int',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|int',
            'original_price' => 'required|int',
            'count' => 'required|int',
        ]);
        $image = time() .'_'. rand(1,1000) .'.'.$request->image->extension();  
        $insertItem = DB::table('items')->insert([
            'user_id' => session()->get('seller')->id,
            'cat_id' => $request->categories,
            'sub_cat_id' => $request->sub_categories,
            'item_name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'count' => $request->count,
            'tags' => $request->tags,
            'created_at' => date('Y-m-d h:m:s')
        ]);
        if($insertItem){
            $request->image->move(public_path('uploads/images'),$image);
            return back()->with('success','Product added successfully');
        }
    }
}
