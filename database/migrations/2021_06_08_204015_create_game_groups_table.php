<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('developer');
            $table->tinyInteger('sign_id');
            $table->tinyInteger('cooperation_mode');
            $table->smallInteger('cate_theme_id');
            $table->smallInteger('cate_type_id');
            $table->string('game_secret');
            $table->string('app_sign');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('mark')->nullable();
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
        Schema::dropIfExists('game_groups');
    }
}
