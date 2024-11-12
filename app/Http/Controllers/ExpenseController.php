<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\CostCenter; 
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['user', 'expenseType', 'costCenter'])->latest()->get();
        return view('expenses.index', compact('expenses'));  
    }

    public function create()
    {
        $expenseTypes = ExpenseType::all();
        $costCenters = CostCenter::all();
        return view('expenses.create', compact('expenseTypes', 'costCenters'));
    }

    public function store(Request $request)
    {
        try {    
            // Get all data and clean amount before validation
            $data = $request->all();
            
            if (isset($data['amount'])) {
                $data['amount'] = str_replace(',', '', $data['amount']);
            }
    
            // Create new request with cleaned data
            $request->merge(['amount' => $data['amount']]);
            
            $validated = $request->validate(Expense::$rules);
    
            $expense = new Expense($validated);
            $expense->user_id = auth()->id();
            
            $expense->save();
    
            return redirect()
                ->route('expenses.index')
                ->with('success', 'Expense created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()
                ->back()
                ->with('error', 'Error creating expense: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $expenseTypes = ExpenseType::all();
        $costCenters = CostCenter::all();
        return view('expenses.edit', compact('expense', 'expenseTypes', 'costCenters'));
    }

    public function update(Request $request, Expense $expense)
    {
        try {    
            // Get all data and clean amount before validation
            $data = $request->all();
            
            if (isset($data['amount'])) {
                $data['amount'] = str_replace(',', '', $data['amount']);
            }
    
            // Create new request with cleaned data
            $request->merge(['amount' => $data['amount']]);
            
            $validated = $request->validate(Expense::$rules);
    
            $expense->update($validated);
    
            return redirect()
                ->route('expenses.index')
                ->with('success', 'Expense updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in update:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()
                ->back()
                ->with('error', 'Error updating expense: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();
            return redirect()
                ->route('expenses.index')
                ->with('success', 'Expense deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('expenses.index')
                ->with('error', 'Error deleting expense.');
        }
    }
}