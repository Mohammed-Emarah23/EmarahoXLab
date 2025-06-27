<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function redirect(){
        $products=Product::all();
        return view('Client.home',compact('products'));
    }

    public function adminHome(){
        $user=User::all();
        return view('Admin.home',compact('user'));
    }
}
