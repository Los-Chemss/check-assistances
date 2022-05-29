<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function scopeCriterion($query, $criteria, $input)
    {
        return $query->where($criteria, '>=', date('Y-m-d', strtotime($input)));

        // return $query->where($criteria, 'LIKE', "%$input%");
    }
}
