<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('display_order')
            ->latest()
            ->paginate(10);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/sliders'),
                $imageName
            );
        }

        Slider::create([
            'title'         => $request->title,
            'subtitle'      => $request->subtitle,
            'image'         => $imageName,
            'button_text'   => $request->button_text,
            'button_link'   => $request->button_link,
            'display_order' => $request->display_order ?? 1,
            'status'        => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider Added Successfully.');
    }
}
