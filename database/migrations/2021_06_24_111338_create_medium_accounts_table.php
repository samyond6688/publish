<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //media_id type account password account_id account_name agent_id company_id owner status mark
        Schema::create('medium_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('media_id');
            $table->smallInteger('type');
            $table->string('account');
            $table->string('password');
            $table->string('account_id')->nullable();
            $table->string('account_name')->nullable();
            $table->smallInteger('agent_id');
            $table->smallInteger('company_id');
            $table->string('owner')->nullable();
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
        Schema::dropIfExists('medium_accounts');
    }
}
