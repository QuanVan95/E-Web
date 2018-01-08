<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('module_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_categories');
    }
}
