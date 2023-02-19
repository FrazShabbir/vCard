<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable()->default(12);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('delivery_address');
            $table->string('status');

            $table->string('coupon')->nullable();
            $table->string('discount')->nullable();
            $table->string('shipping')->nullable();
            $table->string('price')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('total')->nullable();
            
            $table->string('type')->default('default');
            $table->timestamps();
            $table->softDeletes();
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
};
