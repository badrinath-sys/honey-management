<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        if ($request->category) {

            $query->where('category_id', $request->category);

        }

        $products = $query->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('stock.index', compact('products'));
    }
}
