<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelledProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'selled_products';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
