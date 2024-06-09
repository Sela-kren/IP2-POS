<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id'); // Adding the type_id column
            $table->string('code');
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('unit_price');
            $table->integer('stock')->nullable();
            // $table->integer('discount')->nullable(); // primaty key of promotion
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();


            $table->foreign('type_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
