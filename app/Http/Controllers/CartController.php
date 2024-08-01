<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Product is out of stock.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        $product->stock--;
        $product->save();

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product) {
                $product->stock += $cart[$productId]['quantity'];
                $product->save();
            }
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart', compact('cart', 'totalPrice'));
    }
}
