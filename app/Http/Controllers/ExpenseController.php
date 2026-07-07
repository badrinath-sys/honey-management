<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->search) {

            $query->where('title', 'like', '%' . $request->search . '%');

        }

        $expenses = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title'        => 'required|max:150',

            'amount'       => 'required|numeric',

            'expense_date' => 'required|date',

            'description'  => 'nullable',

        ]);

        Expense::create($request->all());

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Added Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return redirect()->route('expenses.edit', $expense->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([

            'title'        => 'required|max:150',

            'amount'       => 'required|numeric',

            'expense_date' => 'required|date',

            'description'  => 'nullable',

        ]);

        $expense->update([

            'title'        => $request->title,

            'amount'       => $request->amount,

            'expense_date' => $request->expense_date,

            'description'  => $request->description,

        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Updated Successfully');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Deleted Successfully');
    }
}
