<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function check(){
        if(Auth::user()->role == "admin"){
            $user=User::all();
            return view('Admin.home',compact('user'));
            return view('Client.home');
            // 
            $products=Product::all();
            $cart=session()->get("cart");
            dd($cart);
            return view('Admin.home',compact('products'));
        }else{
            $users=User::all();
            return view('Client.home',compact('users'));
            $products = Product::all();
            $cart=session()->get("cart");
            dd($cart);
            return view('Client.home', compact('products'));

        }
    }
}
