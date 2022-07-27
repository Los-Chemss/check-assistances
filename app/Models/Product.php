<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sold()
    {
        return $this->hasMany(SelledProduct::class);
    }
    public function purchased()
    {
        return $this->hasMany(PurchasedProduct::class);
    }

}
