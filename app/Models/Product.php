<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'code', 'name', 'image', 'unit_price', 'discount', 'description'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
