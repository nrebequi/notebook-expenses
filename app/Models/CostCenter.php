<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cost_centers';

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
        'code' => 'required|string|max:3|unique:cost_centers,code',
        'name' => 'required|string|max:25',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}