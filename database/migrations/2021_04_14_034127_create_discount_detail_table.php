<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_detail', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('sku')->on('product');
            $table->integer('discount_id')->unsigned();
            $table->foreign('discount_id')->references('id')->on('discount');
            $table->primary(['product_id','discount_id']);
            $table->unsignedDecimal('product_discount',$total = 25, $places = 2);
            $table->string('note');
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
        Schema::dropIfExists('discount_detail');
    }
}
