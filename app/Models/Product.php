<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use app\Models\ProductType;
use app\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'code', 'name', 'image', 'unit_price', 'description','stock'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }

}
