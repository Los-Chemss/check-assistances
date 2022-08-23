<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;
    protected $fillable = [
        'input',
        'output',
        'customer_id',
        'branch_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function scopeCriterion($query, $criteria, $input)
    {
       /*  if ($criteria == 'income' && $input) {
            return $query->where('income', '>=', date('Y-m-d', strtotime($input)));
        } */
        return $query->where($criteria, 'LIKE', "%$input%");
    }
}
