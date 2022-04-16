<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToVoucherDetailsToVoucherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_details', function (Blueprint $table) {
            DB::statement('ALTER TABLE `voucher_details` CHANGE `account_type` `account_type` ENUM(\'debit\',\'credit\',\'\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
            $table->boolean('transaction_type')->default(true)->after('account_type')->comment('1=original,0=dummy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher_details', function (Blueprint $table) {
            DB::statement('ALTER TABLE `voucher_details` CHANGE `account_type` `account_type` ENUM(\'debit\',\'credit\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
            $table->dropColumn('transaction_type');
        });
    }
}
