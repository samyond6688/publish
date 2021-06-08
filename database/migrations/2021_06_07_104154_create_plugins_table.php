<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *

     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('');
            $table->string('comain')->default('');
            $table->string('account')->default('');
            $table->string('password')->default('');
            $table->string('login_url')->default('');
            $table->tinyInteger('account_type')->default(1);
            $table->string('admin_name')->default('');
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
        Schema::dropIfExists('plugins');
    }
}
