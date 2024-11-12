<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expense_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * The validation rules.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'code' => 'required|string|size:3|unique:expense_types,code',
        'name' => 'required|string|max:25',
    ];
}