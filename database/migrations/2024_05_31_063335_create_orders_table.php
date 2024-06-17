<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id', true);

            $table->integer('receipt_number')->unsigned()->nullable();

            $table->integer('cashier_id')->index()->unsigned();
            $table->foreign('cashier_id')->references('id')->on('user')->onDelete('cascade');
            $table->double('total_price')->nullable();
            $table->integer('discount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
