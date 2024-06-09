<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('promotion_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('promotion_id');
            $table->string('name');
            $table->decimal('discount_percentage', 5, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            // $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('promotion_history');
    }
};

