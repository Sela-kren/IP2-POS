<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\ProductType;
use App\Models\OrderDetail;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'code', 'name', 'image', 'unit_price', 'description', 'stock','product_name'
    ];

    public function orderDetails(): HasMany // 1:M relationship with OrderDetail
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }   
    
    public function promotion(): HasOne
    {
        return $this->hasOne(Promotion::class, 'product_id');
    }

}