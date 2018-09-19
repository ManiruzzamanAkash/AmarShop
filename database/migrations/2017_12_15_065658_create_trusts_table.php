<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrustsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trusts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trustee_id')->unsigned()->comment('the user id who is trusted');
            $table->integer('user_id')->unsigned()->comment('the user id who trust trustee');
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
        Schema::dropIfExists('trusts');
    }
}
