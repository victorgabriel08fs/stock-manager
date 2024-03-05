<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'photo',
        'amount',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sales', 'product_id', 'sale_id');
    }

    public function scopeFilter($query, $request)
    {
        if (!$request) {
            return $query;
        }

        return $query->when($request['name'], function ($q, $name) {
            return $q->where('name', 'like', '%' . $name . '%');
        })->when($request['category_id'], function ($q, $category_id) {
            return $q->where('category_id', $category_id);
        });
    }
}
