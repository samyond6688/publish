<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginParamsTable extends Migration
{
    /**
     * Run the migrations.
     *

     * @return void
     */
    public function up()
    {
        Schema::create('plugin_params', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('');
            $table->tinyInteger('sign')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->string('plugin_use')->default(1);
            $table->string('params')->default('');
            $table->tinyInteger('status')->default(1);
            $table->string('remark')->nullable('');
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
        Schema::dropIfExists('plugin_params');
    }
}
