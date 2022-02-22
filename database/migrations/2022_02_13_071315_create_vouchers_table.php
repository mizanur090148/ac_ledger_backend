<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_no', 30);
            $table->smallInteger('voucher_type')->default(0)->comment('0=debit/payment,1=credit/receive,2=contra,3=journal');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->date('created_date')->useCurrent();
            $table->string('reference')->nullable();
            $table->enum('pay_mode', ['cash','bank']);
            $table->unsignedBigInteger('credit_by')->nullable();
            $table->enum('currency', ['bdt','usd','euro'])->default('bdt');
            $table->unsignedBigInteger('debit_by')->nullable();
            $table->string('cheque_no', 60)->nullable();
            $table->date('due_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('message_to_accountant')->nullable();
            $table->string('message_to_management')->nullable();
            $table->string('message_for_audit')->nullable();
            $table->activitiesBy();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
