<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->date('date_of_birth');
            $table->integer('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('gender');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('image');
            $table->integer('customer_type_id')->unsigned();
            $table->foreign('customer_type_id')->references('id')->on('customer_type');
            $table->string('email', 200)->nullable();
            $table->string('phone', 50)->unique('phone');
            $table->string('address', 300)->nullable();
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('cus_account');
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
        Schema::dropIfExists('customer');
    }
}
