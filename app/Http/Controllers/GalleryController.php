<?php
namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();

        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status'     => 'required|boolean',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/gallery'), $imageName);
        }

        Gallery::create([
            'title'      => $request->title,
            'image'      => $imageName,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Gallery Image Added Successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'      => 'required|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status'     => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            if ($gallery->image && file_exists(public_path('uploads/gallery/' . $gallery->image))) {
                unlink(public_path('uploads/gallery/' . $gallery->image));
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/gallery'), $imageName);

            $gallery->image = $imageName;
        }

        $gallery->title      = $request->title;
        $gallery->sort_order = $request->sort_order ?? 0;
        $gallery->status     = $request->status;
        $gallery->save();

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Gallery Updated Successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists(public_path('uploads/gallery/' . $gallery->image))) {
            unlink(public_path('uploads/gallery/' . $gallery->image));
        }

        $gallery->delete();

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Gallery Deleted Successfully.');
    }
}
