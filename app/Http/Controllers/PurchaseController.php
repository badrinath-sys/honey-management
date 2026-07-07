<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('purchases.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'    => 'required|exists:suppliers,id',
            'purchase_date'  => 'required|date',
            'payment_status' => 'required',
        ]);

        $purchase = Purchase::create([
            'supplier_id'    => $request->supplier_id,
            'purchase_date'  => $request->purchase_date,
            'payment_status' => $request->payment_status,
            'total_amount'   => 0,
        ]);

        return redirect()
            ->route('purchases.edit', $purchase->id)
            ->with('success', 'Purchase Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return redirect()->route('purchases.edit', $purchase->id);
    }

/**
 * Show the form for editing the specified resource.
 */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::where('status', 1)
            ->orderBy('name')
            ->get();

        $products = Product::where('status', 1)
            ->orderBy('name')
            ->get();

        $purchase->load('supplier', 'items.product');

        return view('purchases.edit', compact(
            'purchase',
            'suppliers',
            'products'
        ));
    }

/**
 * Update the specified resource.
 */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id'    => 'required|exists:suppliers,id',
            'purchase_date'  => 'required|date',
            'payment_status' => 'required',
        ]);

        $purchase->update([
            'supplier_id'    => $request->supplier_id,
            'purchase_date'  => $request->purchase_date,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()
            ->route('purchases.edit', $purchase->id)
            ->with('success', 'Purchase Updated Successfully');
    }
/**
 * Add Product to Purchase
 */
    public function addItem(Request $request, Purchase $purchase)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price'      => 'required|numeric|min:1',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $subtotal = $request->price * $request->quantity;

        // Check if product already exists in purchase
        $item = PurchaseItem::where('purchase_id', $purchase->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {

            $item->quantity += $request->quantity;
            $item->price     = $request->price;
            $item->subtotal  = $item->quantity * $request->price;
            $item->save();

        } else {

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id'  => $product->id,
                'price'       => $request->price,
                'quantity'    => $request->quantity,
                'subtotal'    => $subtotal,
            ]);

        }

        // Increase Stock
        $product->increment('quantity', $request->quantity);

        // Update Purchase Total
        $purchase->update([
            'total_amount' => $purchase->items()->sum('subtotal'),
        ]);

        return back()->with('success', 'Product Added Successfully');
    }

    /**
     * Remove Product From Purchase
     */
    public function removeItem(PurchaseItem $item)
    {
        $product = $item->product;

        // Reduce Stock
        $product->decrement('quantity', $item->quantity);

        $purchase = $item->purchase;

        $item->delete();

        // Update Total
        $purchase->update([
            'total_amount' => $purchase->items()->sum('subtotal'),
        ]);

        return back()->with('success', 'Product Removed Successfully');
    }

    /**
     * Delete Purchase
     */
    public function destroy(Purchase $purchase)
    {
        // Return stock before deleting purchase
        foreach ($purchase->items as $item) {

            $item->product->decrement('quantity', $item->quantity);

        }

        $purchase->items()->delete();

        $purchase->delete();

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Purchase Deleted Successfully');
    }
}
