<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_detail', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('sku')->on('product');
            $table->integer('import_id')->unsigned();
            $table->foreign('import_id')->references('id')->on('import');
            $table->primary(['product_id','import_id']);
            $table->unsignedInteger('amount');
            $table->unsignedDecimal('basic_price',$total = 25, $places = 2);
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
        Schema::dropIfExists('import_detail');
    }
}
