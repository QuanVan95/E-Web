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
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->text('id_card')->nullable();
            $table->text('phone')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->integer('group_id')->default(0);
            $table->integer('is_admin')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by');
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
