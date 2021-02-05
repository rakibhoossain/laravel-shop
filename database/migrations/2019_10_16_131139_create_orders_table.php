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
            $table->bigIncrements('id');
            $table->string('order_number', 100)->unique();
            $table->unsignedInteger('user_id');
            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('shipping_id')->nullable();
            $table->string('first_name', 60);
            $table->string('last_name', 65);
            $table->text('address');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('country', 40);
            $table->string('post_code', 10);
            $table->string('phone_number', 25);
            $table->text('notes')->nullable();
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
