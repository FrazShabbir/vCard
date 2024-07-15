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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('bio')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->string('avatar')->default('default/avatar/default.png');
            $table->string('cover_image')->default('default/cover/placeholder.png');
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('template_id')->nullable()->default('1');
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
        Schema::dropIfExists('profiles');
    }
};
