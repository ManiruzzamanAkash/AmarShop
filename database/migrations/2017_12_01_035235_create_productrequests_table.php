<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productrequests', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title', 150);
          $table->string('price_range', 20);
          $table->text('description', 1000);
          $table->string('phone', 20);
          $table->string('size', 6);
          $table->string('slug', 170);
          $table->tinyInteger('publish_status')->unsigned()->default(0)->comment('0=Un published | 1=Published');

          $table->string('image', 20)->nullable();
          $table->integer('brand_id')->unsigned()->nullable();

          $table->integer('division_id')->unsigned();
          $table->integer('district_id')->unsigned();
          $table->integer('category_id')->unsigned();
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('company_id')->unsigned()->nullable();

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
        Schema::dropIfExists('productrequests');
    }
}
