<?php
namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $setting = WebsiteSetting::first();

        if (! $setting) {
            $setting = WebsiteSetting::create();
        }

        return view('website-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'required|max:100',
            'phone'        => 'nullable|max:20',
            'email'        => 'nullable|email',
        ]);

        $setting = WebsiteSetting::first();

        if (! $setting) {
            $setting = WebsiteSetting::create();
        }

        $data = $request->except(['logo', 'favicon']);

        // Logo Upload
        if ($request->hasFile('logo')) {

            $logo = time() . '_logo.' . $request->logo->extension();

            $request->logo->move(public_path('uploads/settings'), $logo);

            $data['logo'] = $logo;
        }

        // Favicon Upload
        if ($request->hasFile('favicon')) {

            $favicon = time() . '_favicon.' . $request->favicon->extension();

            $request->favicon->move(public_path('uploads/settings'), $favicon);

            $data['favicon'] = $favicon;
        }

        $setting->update($data);

        return back()->with('success', 'Website Settings Updated Successfully.');
    }
}
