<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertAdminUsersIsFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->tinyInteger('is_first')->default('0');
            $table->string('email',20)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('is_first');
            $table->dropColumn('email');
        });
    }
}
