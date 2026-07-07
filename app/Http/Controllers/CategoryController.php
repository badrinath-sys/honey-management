<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display Categories
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $categories = $query
            ->orderBy('sort_order', 'ASC')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store Category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('assets/images/categories'), $imageName);
        }

        Category::create([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'description' => $request->description,
            'image'       => $imageName,
            'status'      => $request->status,
            'sort_order'  => $request->sort_order,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Created Successfully.');
    }

    /**
     * Show Edit Form
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update Category
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $imageName = $category->image;

        if ($request->hasFile('image')) {

            if (
                $category->image &&
                file_exists(public_path('assets/images/categories/' . $category->image))
            ) {
                unlink(public_path('assets/images/categories/' . $category->image));
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('assets/images/categories'), $imageName);
        }

        $category->update([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'description' => $request->description,
            'image'       => $imageName,
            'status'      => $request->status,
            'sort_order'  => $request->sort_order,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Updated Successfully.');
    }

    /**
     * Delete Category
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (
            $category->image &&
            file_exists(public_path('assets/images/categories/' . $category->image))
        ) {
            unlink(public_path('assets/images/categories/' . $category->image));
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Deleted Successfully.');
    }
}
