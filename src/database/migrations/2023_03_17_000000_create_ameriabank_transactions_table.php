<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmeriabankTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ameriabank_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable()->index();
            $table->string('payment_id')->nullable()->index();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->string('Amount')->nullable();
            $table->string('ApprovedAmount')->nullable();
            $table->string('ApprovalCode')->nullable();
            $table->string('CardNumber')->nullable();
            $table->string('ClientName')->nullable();
            $table->string('ExpDate')->nullable();
            $table->string('Currency')->nullable();
            $table->string('DateTime')->nullable();
            $table->string('DepositedAmount')->nullable();
            $table->string('Description')->nullable();
            $table->string('MDOrderID')->nullable();
            $table->string('MerchantId')->nullable();
            $table->string('TerminalId')->nullable();
            $table->string('PaymentState')->nullable();
            $table->string('ResponseCode')->nullable();
            $table->string('ProcessingIP')->nullable();
            $table->string('Provider')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ameriabank_transactions');
    }
}
