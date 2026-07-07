<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Wishlist Page
     */
    public function index()
    {

        $items = Wishlist::with('product')
            ->where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->get();

        return view('frontend.wishlist.index', compact('items'));
    }

    /**
     * Add Product
     */
    public function add($id)
    {
        $customerId = Auth::guard('customer')->id();

        $exists = Wishlist::where('customer_id', $customerId)
            ->where('product_id', $id)
            ->exists();

        if (! $exists) {

            Wishlist::create([
                'customer_id' => $customerId,
                'product_id'  => $id,
            ]);
        }

        return back()->with('success', 'Product added to Wishlist.');
    }

    /**
     * Remove Product
     */
    public function remove($id)
    {
        Wishlist::where('customer_id', Auth::guard('customer')->id())
            ->where('product_id', $id)
            ->delete();

        return back()->with('success', 'Product removed from Wishlist.');
    }
}
