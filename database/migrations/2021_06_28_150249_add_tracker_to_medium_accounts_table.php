<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackerToMediumAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medium_accounts', function (Blueprint $table) {
            $table->string('tracker')->nullable()->comment('追踪码')->after('account_name');
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
            $table->dropColumn('tracker');
        });
    }
}
