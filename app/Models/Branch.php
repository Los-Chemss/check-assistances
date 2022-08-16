<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'registered_on_branch_id', 'id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'branch_id', 'id');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'branch_id', 'id');
    }
}
