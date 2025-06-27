<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

// All Product 
   public function all(){
    $products = Product::all();
        return view('Admin.products', compact('products'));
    $user=User::all();
        return view('Admin.home',compact('user'));
   }   

//  Redirect To Add Form 
    public function AddForm(){
        return view('Admin.AddForm');
    }

    // Store
    public function store(Request $request){
    // validation 
    $data = $request->validate([
        "name" => "required|string|max:255",
        "desc" => "required|string|max:255",
        "price" => "required|numeric",
        "image" => "required|file|mimes:png,jpg,jpeg,svg",
        "quantity" => "required|numeric"
    ]);

    // Save Image 
    $data['image'] = $request->file('image')->store('Product');

    // Create Product 
    Product::create($data);

    // Redirect
    return redirect()->route('all-products')->with('success', 'Product Created Successfully');
}

// Redirect To Edit Form 
public function EditForm($id){
    $product=Product::findOrFail($id);
    return view('Admin.EditForm',compact('product'));
}
    // Edit 
    public function edit(Request $request , $id ){
        // Check id 
        $product=Product::findOrFail($id);
        // Validation 
        $data=$request->validate([
                "name" => "required|string|max:255",
                "desc" => "required|string|max:255",
                "price" => "required|numeric",
                "image" => "required|file|mimes:png,jpg,jpeg,svg",
                "quantity" => "required|numeric"
        ]);
        // Image 
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $data['image'] = Storage::putFile('Product', $request->file('image'));
        } else {
            $data['image'] = $product->image;
        }

        // Update Data 
        $product->update($data);

        // Redirect 
            return redirect()->route('all-products')->with('success', 'Product updated successfully!'); 
    }


    // Delete
    public function delete(Request $request , $id){
        /*
            1-Check by id
            2-use Storage to delete
            3-Delete All Data
            4- Return to All page with all categories ..
         */
        $product=Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
        $products = Product::all();
          return redirect()->route('all-products')->with('success', 'Product deleted successfully!'); 

    }
}
