<?php
namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');

            });

        }

        $customers = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }
    public function export()
    {
        return Excel::download(
            new CustomersExport,
            'customers.xlsx'
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'    => 'required|max:100',

            'phone'   => 'required|max:15|unique:customers,phone',

            'email'   => 'nullable|email|max:100',

            'address' => 'nullable|max:500',

            'status'  => 'required|boolean',

        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return redirect()->route('customers.edit', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([

            'name'    => 'required|max:100',

            'phone'   => 'required|max:15|unique:customers,phone,' . $customer->id,

            'email'   => 'nullable|email|max:100',

            'address' => 'nullable|max:500',

            'status'  => 'required|boolean',

        ]);

        $customer->update([

            'name'    => $request->name,

            'phone'   => $request->phone,

            'email'   => $request->email,

            'address' => $request->address,

            'status'  => $request->status,

        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer Deleted Successfully');
    }
}
