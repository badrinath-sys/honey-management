<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $categories = Category::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::where('status', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $bestSellerProducts = Product::where('status', 1)
            ->where('is_best_seller', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact(
            'categories',
            'featuredProducts',
            'bestSellerProducts'
        ));
    }
    public function products()
    {
        $products = Product::where('status', 1)->paginate(12);

        return view('frontend.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('status', 1)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('frontend.product-details', compact('product', 'relatedProducts'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->paginate(12);

        return view('frontend.category', compact('category', 'products'));
    }
    public function shop(Request $request)
    {
        $categories = Category::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $products = Product::with('category')
            ->where('status', 1);

        // Search
        if ($request->filled('search')) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        $products = $products->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.shop', compact('categories', 'products'));
    }
    public function search(Request $request)
    {
        $keyword = trim($request->search);

        $products = Product::where('status', 1)
            ->where(function ($query) use ($keyword) {

                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%");

            })
            ->paginate(12)
            ->appends([
                'search' => $keyword,
            ]);

        return view('frontend.search', compact('products', 'keyword'));
    }
    public function offers()
    {
        $products = Product::where('status', 1)
            ->where('is_offer', 1)
            ->paginate(12);

        return view('frontend.offers', compact('products'));
    }

    public function gallery()
    {
        $galleries = Gallery::where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('frontend.gallery', compact('galleries'));
    }
    use App\Models\ContactEnquiry;
    use Illuminate\Http\Request;

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'phone'   => 'required|max:20',
            'email'   => 'nullable|email',
            'subject' => 'required|max:150',
            'message' => 'required',
        ]);

        ContactEnquiry::create($request->all());

        return back()->with('success', 'Thank you! We will contact you soon.');
    }
}
