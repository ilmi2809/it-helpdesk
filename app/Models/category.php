<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SlaPolicy;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'parent_id',   // <-- penting
        'slug',        // kalau kamu punya kolom slug
        'order',       // kalau kamu pakai kolom order
    ];

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

    public function scopeParents($q)
    {
        return $q->whereNull('parent_id');
    }

    public function scopeChildrenOf($q,$id)
    {
        return $q->where('parent_id',$id);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
}

