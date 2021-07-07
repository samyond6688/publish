<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner', function (Blueprint $table) {
            $table->string('tax_id_label')->nullable()->after('partner_type')->comment('纳税识别号');
            $table->string('tax_address')->nullable()->after('tax_id_label')->comment('注册地址');
            $table->string('tax_bank')->nullable()->after('tax_address')->comment('开户银行');
            $table->string('tax_bank_account')->nullable()->after('tax_bank')->comment('银行账号');
            $table->string('tax_mobile')->nullable()->after('tax_bank_account')->comment('电话');
            $table->string('tax_item_type')->nullable()->after('tax_mobile')->comment('开票项目');

            $table->string('collection_bank')->nullable()->after('tax_item_type')->comment('收款银行');
            $table->string('collection_bank_account')->nullable()->after('collection_bank')->comment('收款账号');
            $table->string('collection_desc')->nullable()->after('collection_bank_account')->comment('备注');

            $table->string('addressee_name')->nullable()->after('collection_desc')->comment('收件人');
            $table->string('addressee_address')->nullable()->after('addressee_name')->comment('收件人地址');
            $table->string('addressee_desc')->nullable()->after('addressee_address')->comment('备注');
            $table->string('addressee_mobile')->nullable()->after('addressee_desc')->comment('联系电话');
            $table->tinyInteger('status')->default('0')->after('addressee_mobile')->comment('状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner', function (Blueprint $table) {
            $table->dropColumn('tax_id_label');
            $table->dropColumn('tax_address');
            $table->dropColumn('tax_bank');
            $table->dropColumn('tax_bank_account');
            $table->dropColumn('tax_mobile');
            $table->dropColumn('tax_item_type');

            $table->dropColumn('collection_bank');
            $table->dropColumn('collection_bank_account');
            $table->dropColumn('collection_desc');

            $table->dropColumn('addressee_name');
            $table->dropColumn('addressee_address');
            $table->dropColumn('addressee_desc');
            $table->dropColumn('addressee_mobile');
            $table->dropColumn('status');
        });
    }
}
