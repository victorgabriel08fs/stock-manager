<?php

namespace App\Models;

use App\Observers\SaleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_value',
        'total_amount',
        'status',
    ];
    
    protected static function boot()
    {
        parent::boot();

        Sale::observe(SaleObserver::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sales', 'sale_id', 'product_id')->withPivot('product_amount');
    }

}
