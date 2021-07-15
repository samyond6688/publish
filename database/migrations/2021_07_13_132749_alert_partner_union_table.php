<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertPartnerUnionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cates', function (Blueprint $table) {
            $table->string('developer')->change();;
            $table->string('sign_id')->change();;
        });
        Schema::table('medium_accounts', function (Blueprint $table) {
            $table->string('agent_id')->change();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->string('publisher_id')->change();
            $table->string('sign_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medium_accounts', function (Blueprint $table) {
            $table->smallInteger('agent_id')->change();;
        });
        Schema::table('games', function (Blueprint $table) {
            $table->smallInteger('publisher_id')->change();
            $table->smallInteger('sign_id')->change();;
        });
        Schema::table('cates', function (Blueprint $table) {
            $table->smallInteger('developer')->change();
            $table->smallInteger('sign_id')->change();;
        });
    }
}
