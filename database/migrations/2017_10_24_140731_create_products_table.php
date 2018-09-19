<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 160);
            $table->integer('price')->unsigned();
            $table->text('description', 1000);
            $table->string('phone', 20)->nullable();
            $table->integer('shipping_cost')->unsigned()->nullable()->default(100);
            $table->string('size', 6);
            $table->string('slug', 190);
            $table->tinyInteger('publish_status')->unsigned()->default(0)->comment('0=Un published | 1=Published');

            $table->tinyInteger('is_sold')->unsigned()->default(0)->comment('0=not sold | 1=sold');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('1=old | 2=new');

            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
            $table->integer('brand_id')->unsigned()->nullable();

            $table->integer('division_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();

            //For Offer
            $table->integer('offer_price')->unsigned()->nullable();
            $table->string('offer_expiry_date', 20)->nullable();
            $table->string('offer_message', 100)->nullable();

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
        Schema::dropIfExists('products');
    }
}
