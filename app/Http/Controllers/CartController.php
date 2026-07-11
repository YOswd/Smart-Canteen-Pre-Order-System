<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.cart', compact('cart'));
    }

    public function add(Food $food)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$food->id])) {
            $cart[$food->id]['quantity']++;
        } else {
            $cart[$food->id] = [
                'id' => $food->id,
                'name' => $food->name,
                'price' => $food->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function remove(Food $food)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$food->id])) {
            unset($cart[$food->id]);
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
