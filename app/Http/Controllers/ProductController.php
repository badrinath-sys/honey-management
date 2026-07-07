<?php
namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));

    }
    public function export()
    {
        return Excel::download(
            new ProductsExport,
            'products.xlsx'
        );
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('products.index')
            ->with('success', 'Products Imported Successfully');
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|max:100|unique:products,name',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'weight'      => 'required|max:20',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|max:500',
            'status'      => 'required|boolean',
        ]);
        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('product_images'), $imageName);

        }

        Product::create([
            'category_id'       => $request->category_id,
            'name'              => $request->name,
            'slug'              => $request->slug,
            'sku'               => $request->sku,
            'barcode'           => $request->barcode,
            'short_description' => $request->short_description,

            'price'             => $request->price,
            'mrp'               => $request->mrp,
            'purchase_price'    => $request->purchase_price,

            'quantity'          => $request->quantity,
            'minimum_stock'     => $request->minimum_stock,

            'weight'            => $request->weight,
            'unit'              => $request->unit,

            'image'             => $imageName,

            'description'       => $request->description,

            'is_featured'       => $request->has('is_featured') ? 1 : 0,
            'is_best_seller'    => $request->has('is_best_seller') ? 1 : 0,
            'status'            => $request->has('status') ? 1 : 0,
            'is_offer'          => $request->is_offer,
            'offer_price'       => $request->offer_price,
            'offer_end_date'    => $request->offer_end_date,
            'is_offer'          => 'required|boolean',
            'offer_price'       => 'nullable|numeric|min:0',
            'offer_end_date'    => 'nullable|date',

        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'    => 'required',
            'name'           => 'required|max:255',
            'price'          => 'required|numeric',
            'quantity'       => 'required|integer',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_offer'       => 'required|boolean',
            'offer_price'    => 'nullable|numeric|min:0',
            'offer_end_date' => 'nullable|date',

        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            // Old image delete
            if ($product->image && file_exists(public_path('assets/images/products/' . $product->image))) {
                unlink(public_path('assets/images/products/' . $product->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/products'), $imageName);
        }

        $product->update([

            'category_id'       => $request->category_id,
            'name'              => $request->name,
            'slug'              => $request->slug,
            'sku'               => $request->sku,
            'barcode'           => $request->barcode,
            'short_description' => $request->short_description,

            'price'             => $request->price,
            'mrp'               => $request->mrp,
            'purchase_price'    => $request->purchase_price,

            'quantity'          => $request->quantity,
            'minimum_stock'     => $request->minimum_stock,

            'weight'            => $request->weight,
            'unit'              => $request->unit,

            'image'             => $imageName,

            'description'       => $request->description,

            'is_featured'       => $request->has('is_featured') ? 1 : 0,
            'is_best_seller'    => $request->has('is_best_seller') ? 1 : 0,
            'status'            => $request->has('status') ? 1 : 0,
            'is_offer'          => $request->is_offer,
            'offer_price'       => $request->offer_price,
            'offer_end_date'    => $request->offer_end_date,

        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete Image
        if ($product->image && file_exists(public_path('product_images/' . $product->image))) {
            unlink(public_path('product_images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }

}
