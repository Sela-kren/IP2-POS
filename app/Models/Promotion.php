<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use App\Models\Product;
class Promotion extends Model
{
    protected $fillable = [
        'product_id', 'name', 'discount_percentage', 'start_date', 'end_date'
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($promotion) {
            // Create a new promotion history record when a promotion is created
            PromotionHistory::create([
                'promotion_id' => $promotion->id,
                'product_id' => $promotion->product_id,
                'name' => $promotion->name,
                'discount_percentage' => $promotion->discount_percentage,
                'start_date' => $promotion->start_date,
                'end_date' => $promotion->end_date
            ]);
        });

        static::updating(function ($promotion) {
            // Create a new promotion history record when the promotion is updated
            PromotionHistory::create([
                'promotion_id' => $promotion->id,
                'product_id' => $promotion->product_id,
                'name' => $promotion->getOriginal('name'),
                'discount_percentage' => $promotion->getOriginal('discount_percentage'),
                'start_date' => $promotion->getOriginal('start_date'), // Get the original start date before update
                'end_date' => $promotion->getOriginal('end_date') // Get the original end date before update
            ]);
        });

       
        // static::deleted(function ($promotion) {
        //     // Create a new promotion history record when the promotion is deleted
        //     PromotionHistory::create([
        //         'promotion_id' => $promotion->id,
        //         'product_id' => $promotion->product_id,
        //         'name' => $promotion->name,
        //         'discount_percentage' => $promotion->discount_percentage,
        //         'start_date' => $promotion->start_date,
        //         'end_date' => $promotion->end_date,
        //         'deleted_at' => now() // Record the deletion timestamp
        //     ]);
        // });
        
    }

    // Define the relationship with the PromotionHistory model
    // public function promotionHistory()
    // {
    //     return $this->hasMany(PromotionHistory::class);
    // }
}
