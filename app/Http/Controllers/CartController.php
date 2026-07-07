<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart');
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                'name'     => $product->name,

                'price'    => $product->price,

                'image'    => $product->image,

                'quantity' => 1,

                'weight'   => $product->weight,

            ];

        }

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Product added to cart.');
    }
    /**
     * Update Cart Quantity
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {

            $cart[$request->id]['quantity'] = max(1, (int) $request->quantity);

            session()->put('cart', $cart);
        }

        return redirect()
            ->route('cart')
            ->with('success', 'Cart Updated Successfully.');
    }

    /**
     * Remove Product From Cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return redirect()
            ->route('cart')
            ->with('success', 'Product Removed Successfully.');
    }

    /**
     * Checkout Page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {

            return redirect()
                ->route('shop')
                ->with('error', 'Your cart is empty.');
        }

        return view('frontend.checkout', compact('cart'));
    }
}
