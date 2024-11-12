<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of expense types.
     */
    public function index()
    {
        $expenseTypes = ExpenseType::all();
        return view('expense-types.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new expense type.
     */
    public function create()
    {
        return view('expense-types.create');
    }

    /**
     * Store a newly created expense type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(ExpenseType::$rules);
        
        ExpenseType::create($validated);

        return redirect()
            ->route('expense-types.index')
            ->with('success', 'Expense type created successfully.');
    }

    /**
     * Display the specified expense type.
     */
    public function show(ExpenseType $expenseType)
    {
        return view('expense-types.show', compact('expenseType'));
    }

    /**
     * Show the form for editing the specified expense type.
     */
    public function edit(ExpenseType $expenseType)
    {
        return view('expense-types.edit', compact('expenseType'));
    }

    /**
     * Update the specified expense type.
     */
    public function update(Request $request, ExpenseType $expenseType)
    {
        $rules = ExpenseType::$rules;
        $rules['code'] = 'required|string|max:3|unique:expense_types,code,' . $expenseType->id;
        
        $validated = $request->validate($rules);
        
        $expenseType->update($validated);
    
        return redirect()
            ->route('expense-types.index')
            ->with('success', 'Expense type updated successfully.');
    }

    /**
     * Remove the specified expense type.
     */
    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();

        return redirect()
            ->route('expense-types.index')
            ->with('success', 'Expense type deleted successfully.');
    }
}