<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

