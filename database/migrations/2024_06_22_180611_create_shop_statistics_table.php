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
        Schema::create('shop_statistics', function (Blueprint $table) {
            $table->id();
            // make this table as to record statistics of shop and products for views, using ip address location
            $table->integer('shop_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('ip_address')->nullable();

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
        Schema::dropIfExists('shop_statistics');
    }
};
