<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleVersionsTable extends Migration
{
    public function up()
    {
        Schema::create('module_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->float('version')->nullable();
            $table->integer('status')->default(0);
            $table->text('attribute')->nullable();
            $table->text('api')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_versions');
    }
}
