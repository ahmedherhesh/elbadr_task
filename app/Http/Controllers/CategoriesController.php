<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public static function getCategories(){
        $cats = DB::table('categories')->where('parent_id','=','0')->get();
        return $cats;
    }
    public function getSubCategories(Request $request){
        $sub_categories = DB::table('categories')->where('parent_id','=',$request->categories)->get();
        foreach ($sub_categories as $sub_cat){
            echo '<option value="' . $sub_cat->id . '">' . $sub_cat->category_name . '</option>';
        };
    }
    public function insertCategories(Request $request){
        $request->validate([
            'category_name' => 'required|string',
            'parent_id' => 'required|int',
        ]);
        $insertCategories = DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
        ]);
        if($insertCategories){
            return back();
        }
    }
}
