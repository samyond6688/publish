<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoCostProductsCateId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_products', function (Blueprint $table) {
            $table->integer('cate_id')->nullable(false);
            $table->tinyInteger('is_subscribe')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_products', function (Blueprint $table) {
            $table->dropColumn('cate_id');
            $table->dropColumn('is_subscribe');
        });
    }
}
