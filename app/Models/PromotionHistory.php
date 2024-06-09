<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionHistory extends Model
{
    protected $table = 'promotion_history'; // Specify the table name if it's different from the default convention

    protected $fillable = [
        'promotion_id','product_id','name', 'discount_percentage','start_date', 'end_date', 'deleted_at'
    ];

    protected $dates = ['deleted_at']; // Define deleted_at as a date field

    // Define the relationship with the Promotion model
    // public function promotion()
    // {
    //     return $this->belongsTo(Promotion::class);
    // }
    
}
