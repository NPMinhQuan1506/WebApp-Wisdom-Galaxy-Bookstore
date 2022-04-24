<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->date('date_of_birth');
            $table->integer('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('gender');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade')->onUpdate('cascade');;
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('emp_account');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('image');
            $table->string('email', 200);
            $table->string('phone', 50)->unique('phone');
            $table->string('address', 300);
            $table->unsignedDecimal('salary',$total = 25, $places = 2);
            $table->dateTime('hire_date');
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
        Schema::dropIfExists('Employee');
    }
}
