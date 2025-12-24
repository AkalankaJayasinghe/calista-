<?php

namespace App\Http\Controllers\Marketplace;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product; // ඔයාගේ Product Model එක

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // මුළු එකතුව (Total) ගණනය කිරීම
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('marketplace.cart.index', compact('cart', 'total'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // බාණ්ඩය දැනටමත් Cart එකේ තිබේ නම් Quantity වැඩි කරන්න
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // අලුතින් එකතු කරන්න
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image // Database එකේ image column එකේ නම
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}
