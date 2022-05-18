<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfactor extends Model
{
    use HasFactory;

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }
    public function criteria()
    {
        return $this->hasMany(Criterion::class);
    }
}