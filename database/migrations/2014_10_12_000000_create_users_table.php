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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique(); 
            $table->string('email')->unique();

            $table->string('bio')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();

            $table->string('phone')->nullable();
            $table->text('avatar')->nullable();
            $table->text('cover_image')->nullable();
            
            $table->text('address')->nullable();

            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('pinterest')->nullable();

            $table->string('url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->boolean('terms')->nullable()->default(1);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
