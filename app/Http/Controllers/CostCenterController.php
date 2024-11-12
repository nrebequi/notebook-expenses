<?php

namespace App\Http\Controllers;

use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function index()
    {
        $costCenters = CostCenter::all();
        return view('cost-centers.index', compact('costCenters'));
    }

    public function create()
    {
        return view('cost-centers.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(CostCenter::$rules);
            CostCenter::create($validated);
            
            return redirect()
                ->route('cost-centers.index')
                ->with('success', 'Cost center created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error creating cost center: ' . $e->getMessage());
        }
    }

    public function show(CostCenter $costCenter)
    {
        return view('cost-centers.show', compact('costCenter'));
    }

    public function edit(CostCenter $costCenter)
    {
        return view('cost-centers.edit', compact('costCenter'));
    }

    public function update(Request $request, CostCenter $costCenter)
    {
        try {
            $rules = CostCenter::$rules;
            $rules['code'] = 'required|string|max:3|unique:cost_centers,code,' . $costCenter->id;
            
            $validated = $request->validate($rules);
            $costCenter->update($validated);

            return redirect()
                ->route('cost-centers.index')
                ->with('success', 'Cost center updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating cost center: ' . $e->getMessage());
        }
    }

    public function destroy(CostCenter $costCenter)
    {
        try {
            $costCenter->delete();
            return redirect()
                ->route('cost-centers.index')
                ->with('success', 'Cost center deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->route('cost-centers.index')
                ->with('error', 'Error deleting cost center.');
        }
    }
}