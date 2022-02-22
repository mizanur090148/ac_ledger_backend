<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_details', function (Blueprint $table) {
            $table->id();
            $table->enum('account_type', ['debit','credit'])->default('debit');
            $table->unsignedBigInteger('account_head')->nullable();
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('debit_to')->nullable();
            $table->unsignedBigInteger('credit_to')->nullable();
            $table->double('account_balance', 16,4)->nullable();
            $table->string('description')->nullable();
            $table->double('con_rate', 6, 2)->nullable();
            $table->double('fc_amount',16,4)->nullable();
            $table->activitiesBy();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('voucher_id')
                ->references('id')
                ->on('vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_details');
    }
}
