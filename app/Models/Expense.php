<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'date',
        'user_id',
        'expense_type_id',
        'cost_center_id',
        'invoice',
        'amount',
        'notes',
    ];

    /**
     * The validation rules.
     *
     * @var array<string, string>
     */
    
    public static $rules = [
        'date' => 'required|date',
        'expense_type_id' => 'required|exists:expense_types,id',
        'cost_center_id' => 'required|exists:cost_centers,id',
        'invoice' => 'required|string|max:20',
        'amount' => 'required|numeric|min:0',
        'notes' => 'nullable|string',
    ];

    /**
     * Get the user that owns the expense.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the expense type of the expense.
     */
    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }
}