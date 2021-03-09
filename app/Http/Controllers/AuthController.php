<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if(session()->has('seller') || session()->has('customer')){
            return redirect('/');
        }else{
            return view('login');
        }
    }
    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $checkUser = DB::table('users')->where(['email' => $request->email])->first();
        if($checkUser && Hash::check($request->password,$checkUser->password)){
           if($checkUser->role == 'seller'){
                session()->put('seller',$checkUser);
                return redirect('/');
           }else{
                session()->put('customer',$checkUser);
                return redirect('/');
           }
        }else{
            return back()->with('error_login','User or Password is not matched');
        };
    }

    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){
        $request->validate([
            'username' => 'required|string|min:6',
            'personal_mobile' => 'required|string|min:6',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'repeat_password' => 'required_with:password|same:password|min:8',
            'role' => 'required|string'
        ]);
        $ifEmailExist = DB::table('users')->Where([
            'email' => $request->email,
        ])->first();
        if($ifEmailExist){
            return back()->with('email_exist','This Email ' . $request->email . ' is ready exist');
        }else{
            //insert new user
            $register = DB::table('users')->insertGetId([
                'username' => $request->username,
                'personal_mobile' => $request->personal_mobile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'created_at' => now(),
            ]);
            if($register){
                    $checkUser = DB::table('users')->where(['id' => $register])->first();
                    if($checkUser->role == 'seller'){
                        session()->put('seller',$checkUser);
                        return redirect('/');
                    }else{
                        session()->put('customer',$checkUser);
                        return redirect('/');
                    }
                }
            }
    } 
    
    public function logout(){
        if(session()->has('seller')){
            session()->forget('seller');
            return redirect('/login');
        }elseif(session()->has('customer')){
            session()->forget('customer');
            return redirect('/login');
        }else{
            return redirect('/login');
        }
    }
}





