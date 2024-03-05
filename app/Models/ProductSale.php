<?php

namespace App\Models;

use App\Observers\ProductSaleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'product_amount',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
