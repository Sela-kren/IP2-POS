<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Order;
class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    
    public function order() //M:1
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        // return $this->belongsTo(Product::class, 'type_id');
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'id');
    // }
    
}
