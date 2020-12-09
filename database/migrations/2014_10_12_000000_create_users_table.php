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
            $table->increments('id')->comment('AI,PK');
            $table->string('name',50)->comment('user name');
            $table->string('code',50)->unique()->comment('user code');
            $table->string('email')->unique()->comment('user email');
            $table->string('phone',15)->unique()->comment('user phone');
            $table->string('password')->comment('user password');
            $table->unsignedTinyInteger('role_id')->default('2');            
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
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
