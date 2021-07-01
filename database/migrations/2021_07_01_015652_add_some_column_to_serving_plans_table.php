<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToServingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serving_plans', function (Blueprint $table) {
            $table->string('medium_name')->nullable()->after('is_organic')->comment('投放媒体');
            $table->string('medium_account_account')->nullable()->after('medium_name')->comment('媒体账号');
            $table->string('medium_account_account_id')->nullable()->after('medium_account_account')->comment('媒体账号ID');
            $table->string('medium_account_owner_id')->nullable()->after('medium_account_account_id')->comment('归属人');
            $table->string('package_name')->after('medium_account_owner_id')->comment('游戏');
            $table->tinyInteger('package_plugin_type')->after('package_name')->comment('系统');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serving_plans', function (Blueprint $table) {
            $table->dropColumn('medium_name');
            $table->dropColumn('medium_account_account');
            $table->dropColumn('medium_account_account_id');
            $table->dropColumn('medium_account_owner_id');
            $table->dropColumn('package_name');
            $table->dropColumn('package_plugin_type');
        });
    }
}
