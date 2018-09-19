<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_completed_by_admin')->default(0)->comment('Is delivered money by admin or not')->default(0);
            $table->boolean('is_completed_by_company')->default(0)->comment('Is delivered product by company or not')->default(0);
            $table->integer('shipping_id');
            $table->integer('payment_id');
            $table->text('order_message', 500)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
