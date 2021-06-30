<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsOrganicToServingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serving_plans', function (Blueprint $table) {
            $table->tinyInteger('is_organic')->nullable()->default(0)->comment('是否为自然量')->after('adj_creative_id');
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
            $table->dropColumn('is_organic');
        });
    }
}
