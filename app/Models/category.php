<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SlaPolicy;

class Category extends Model
{
    protected $fillable = ['name', 'description'];


    public function slaPolicy()
    {
        return $this->hasOne(SlaPolicy::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(User::class, 'category_technician', 'category_id', 'technician_id');
    }
}

