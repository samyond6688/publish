<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serving_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ad_name')->comment('广告名称')->nullable();
            $table->string('adj_fb_account_id')->nullable()->comment('账号ID，FB投放才有的');
            $table->string('adj_tracker')->nullable()->comment('追踪码');
            $table->string('adj_app_name')->comment('游戏包名');
            $table->string('adj_network_name')->nullable()->comment('adjust-媒体');
            $table->string('adj_campaign_id')->nullable()->comment('adjust-推广计划');
            $table->string('adj_ad_id')->nullable()->comment('adjust-广告ID');
            $table->string('adj_creative_id')->nullable()->comment('adjust-创意ID');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('mark')->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::update("ALTER TABLE serving_plans AUTO_INCREMENT=10000");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serving_plans');
    }
}
