<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    
    public function All()
        {
            $products = Product::take(5)->get();
            return view('Client.home', compact('products'));
        }

    public function userShow($id){
         $product=Product::findOrFail($id);
         return view('Client.Product.show',compact('product'));

    }
    // I'm get with quantity 
   public function addCart(Request $request , $id){
            // Catch Quantity 
            $qty = $request->qty;

            // Check id 
            $product = Product::findOrFail($id);

            // Check if this the first time add to cart or not 
            $cart = session()->get('cart', []);
            
            // if second click you should increase the num of qty
            if(isset($cart[$id])){
                $cart[$id]['qty'] += $qty; // Catch quantity from request and add it to existing qty
            } else {
                // First Time ->  Create New Cart or New Product added to cart
                $cart[$id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "qty" => $qty, // Catch quantity from request ..
                    "image" => $product->image 
                ];
            }

            // Save $cart array in session 
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Product added to cart!');
}
//  Remove Product From Cart 
        public function remove(Request $request)
            {
                $cart = session()->get('cart', []);

                if (isset($cart[$request->id])) {
                     unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }

                    return response()->json(['success' => true]);
                }

// Redirect Cart Page 
        public function cartpage(){
            // Get cart from session (if empty, return empty array instead of null to avoid errors)
            $cart = session()->get('cart', []);
            
            return view('Client.cart', compact('cart'));
    }
}


