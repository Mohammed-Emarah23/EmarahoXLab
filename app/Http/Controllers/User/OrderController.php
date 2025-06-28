<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ✅ Show cart contents
    public function cartpage()
    {
        $cart = session()->get('cart', []);
        return view('Client.cart', compact('cart'));
    }

    // ✅ Review order before confirming
    public function reviewOrder()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $user = Auth::user();
        return view('Client.reviewOrder', compact('cart', 'total', 'user'));
    }

    public function confirmOrder(Request $request)
{
    $user = Auth::user();

    $itemNames = $request->item_name;
    $quantities = $request->qty;
    $unitPrices = $request->unit_price;

    $total = 0;

  
    for ($i = 0; $i < count($itemNames); $i++) {
        $total += $unitPrices[$i] * $quantities[$i];
    }

    if ($user->balance >= $total) {
        $user->balance -= $total;
        $user->save();

        for ($i = 0; $i < count($itemNames); $i++) {
            Order::create([
                'user_id'   => $user->id,
                'item_name' => $itemNames[$i],
                'quantity'  => $quantities[$i],
                'price'     => $unitPrices[$i] * $quantities[$i], 
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cartpage')->with('success', 'Order placed successfully!');
    } else {
        return redirect()->back()->with('error', 'Insufficient balance to complete the order.');
    }
}


    // Show user's past orders
    public function showOrders()
    {
        $orders = Auth::user()->orders;
        return view('User.orders', compact('orders'));
    }

            public function updateCart(Request $request)
        {
            $cart = session()->get('cart', []);

            if (isset($cart[$request->id])) {
                $cart[$request->id]['qty'] = $request->qty;
                session()->put('cart', $cart);
            }

            return response()->json(['success' => true]);
        }

}
