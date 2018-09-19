<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique();
            $table->string('password');

            $table->string('name', 30);
            $table->string('username', 40)->nullable();
            $table->text('description', 500)->nullable();

            $table->integer('division_id')->unsigned();
            $table->integer('district_id')->unsigned();

            $table->string('phone', 20);

            $table->string('token', 100)->nullable();
            $table->tinyInteger('is_verified')->unsigned()->default(0);
            $table->tinyInteger('is_company')->unsigned()->default(0)->comment('0=User | 1=Company');
            $table->tinyInteger('is_admin')->unsigned()->default(0);
            $table->tinyInteger('status')->unsigned()->default(1); //Active User

            $table->string('ip', 50)->nullable();

            $table->string('street_address', 150)->nullable();
            $table->string('website', 50)->nullable();

            $table->string('latitude', 20)->nullable();
            $table->string('langitude', 20)->nullable();
            $table->string('image', 50)->nullable();

            $table->integer('trust_point')->unsigned()->default(0)->comment('When somone trust user, it will increase');

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
        Schema::dropIfExists('users');
    }
}
