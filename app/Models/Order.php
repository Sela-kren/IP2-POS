<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'cashier_id', 'receipt_number', 'total_price', 'discount'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
