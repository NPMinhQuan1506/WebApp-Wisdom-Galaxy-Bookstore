<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('sku')->on('product');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order');
            $table->primary(['product_id','order_id']);
            $table->unsignedInteger('amount');
            $table->unsignedDecimal('selling_price',$total = 25, $places = 2);
            $table->boolean('is_enable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
