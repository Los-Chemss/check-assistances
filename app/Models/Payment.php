<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}