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
            $table->integer('parent_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_categories');
    }
}
