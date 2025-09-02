<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('customer.index', compact('stores'));
    }

    public function showStore(Store $store)
    {
        $store->load('products');
        return view('customer.store', compact('store'));
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request, Product $product)
    {
        $cart = session()->get('cart');

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
        return redirect()->route('cart.index');
    }

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart');

        if(isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully');
    }
}
