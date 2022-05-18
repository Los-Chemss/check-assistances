<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
