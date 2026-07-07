<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    /**
     * Register Page
     */
    public function showRegister()
    {
        return view('frontend.auth.register');
    }

    /**
     * Login Page
     */
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    /**
     * Customer Dashboard
     */
    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();

        return view('frontend.customer.dashboard', compact('customer'));
    }
/**
 * Register Customer
 */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'phone'    => 'required|unique:customers,phone',
            'email'    => 'nullable|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $customer = Customer::create([

            'name'     => $request->name,

            'phone'    => $request->phone,

            'email'    => $request->email,

            'password' => Hash::make($request->password),

            'status'   => 1,

        ]);

        Auth::guard('customer')->login($customer);

        return redirect()
            ->route('customer.dashboard')
            ->with('success', 'Registration Successful.');
    }
    /**
     * Customer Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        if (Auth::guard('customer')->attempt([
            $field     => $request->login,
            'password' => $request->password,
            'status'   => 1,
        ], $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('customer.dashboard');
        }

        return back()
            ->withErrors([
                'login' => 'Invalid Login Credentials',
            ])
            ->withInput();
    }

    /**
     * Customer Logout
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }
    public function profile()
    {
        $customer = Auth::guard('customer')->user();

        return view('frontend.customer.profile', compact('customer'));
    }
    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'name'    => 'required|max:100',
            'email'   => 'nullable|email|unique:customers,email,' . $customer->id,
            'address' => 'nullable|string',
        ]);

        $customer->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile Updated Successfully.');
    }
    public function changePassword()
    {
        return view('frontend.customer.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (! Hash::check($request->current_password, $customer->password)) {

            return back()->withErrors([
                'current_password' => 'Current Password is incorrect.',
            ]);
        }

        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password Changed Successfully.');
    }
    public function addresses()
    {
        return view('frontend.customer.addresses');
    }
}
