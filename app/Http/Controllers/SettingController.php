<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::first();

        if (! $setting) {
            $setting = new Setting();
        }

        $setting->company_name = $request->company_name;
        $setting->owner_name   = $request->owner_name;
        $setting->phone        = $request->phone;
        $setting->email        = $request->email;
        $setting->website      = $request->website;
        $setting->gst          = $request->gst;
        $setting->pan_number   = $request->pan_number;
        $setting->address      = $request->address;

        $setting->bank_name      = $request->bank_name;
        $setting->account_name   = $request->account_name;
        $setting->account_number = $request->account_number;
        $setting->ifsc           = $request->ifsc;
        $setting->branch         = $request->branch;
        $setting->upi_id         = $request->upi_id;

        $setting->terms = $request->terms;

        // Logo
        if ($request->hasFile('logo')) {

            $logo = time() . '_logo.' . $request->logo->extension();

            $request->logo->move(public_path('uploads/settings'), $logo);

            $setting->logo = $logo;
        }

        // QR Code
        if ($request->hasFile('upi_qr')) {

            $qr = time() . '_qr.' . $request->upi_qr->extension();

            $request->upi_qr->move(public_path('uploads/settings'), $qr);

            $setting->upi_qr = $qr;
        }

        // Signature
        if ($request->hasFile('signature')) {

            $sign = time() . '_sign.' . $request->signature->extension();

            $request->signature->move(public_path('uploads/settings'), $sign);

            $setting->signature = $sign;
        }

        $setting->save();

        return back()->with('success', 'Company Settings Saved Successfully.');
    }
}
