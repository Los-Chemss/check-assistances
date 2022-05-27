<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public function payments(){
        return $this->hasMany(Payment::class)->select('id','paid_at','expires_at');
    }
}
