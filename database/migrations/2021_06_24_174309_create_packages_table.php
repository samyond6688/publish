<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
         游戏id 游戏包名称 包名 登录插件 充值插件 adjust秘钥 申请人 插件类型 参数 状态 备注
id game_id name package_name_id plugin_login plugin_pay adjust_key petitioner os plugin_params status mark
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('game_id');
            $table->string('name');
            $table->string('package_name_id');
            $table->string('plugin_login');
            $table->string('plugin_pay');
            $table->tinyInteger('plugin_type');
            $table->string('adjust_key');
            $table->string('petitioner');
            $table->text('plugin_params');
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
        Schema::dropIfExists('packages');
    }
}
