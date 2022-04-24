<?php

use Doctrine\DBAL\Schema\Column;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cus_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique('username');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_enable')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('cus_account');
    }
}
