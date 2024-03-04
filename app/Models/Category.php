<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function scopeFilter($query, $request)
    {
        if (!$request) {
            return $query;
        }

        return $query->when($request['name'], function ($q, $name) {
            return $q->where('name', 'like', '%' . $name . '%');
        });
    }
}
