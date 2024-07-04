<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'cashier_id', 'receipt_number', 'total_price', 'discount'
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id')
            ->select('id', 'name');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id')
            ->select('id', 'order_id', 'quantity', 'product_id', 'unit_price', 'discount')
            ->with(['product:id,name,image']);

    }

    // public function details()// 1:M
    // {
    //     return $this->hasMany(OrderDetail::class, 'order_id')
    //      ->select('id', 'order_id', 'qty', 'product_id', 'unit_price')
    //     ->with([
    //         'product:id,name,image'
    //     ])
    //     ;
    // }

}
