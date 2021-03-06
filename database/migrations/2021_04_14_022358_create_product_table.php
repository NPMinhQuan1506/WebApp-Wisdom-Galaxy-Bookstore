<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('sku');
            $table->string('barcode');
            $table->string('name', 200);
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('image');
            $table->integer('inventory_number')->usigned();
            $table->string('unit', 50);
            $table->integer('min_inventory_number')->usigned();
            $table->string('note', 2000)->nullable();
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
        Schema::dropIfExists('product');
    }
}
