<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('delivery_address_id');
            $table->date('delivery_date');
            $table->boolean('is_am');
            $table->unsignedInteger('delivery_method_id');
            $table->unsignedInteger('delivery_status_id');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('truck_id')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delivery_address_id')->references('id')->on('delivery_addresses');
            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods');
            $table->foreign('delivery_status_id')->references('id')->on('delivery_statuses');
            $table->foreign('truck_id')->references('id')->on('trucks');
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
        Schema::dropIfExists('trucks');
        Schema::dropIfExists('delivery_statuses');
        Schema::dropIfExists('delivery_methods');
    }
}
