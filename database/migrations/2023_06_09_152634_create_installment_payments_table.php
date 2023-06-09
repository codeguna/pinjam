<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->integer('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->char('installment', 2);
            $table->boolean('isPay');
            $table->date('payment_date')->nullable();
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
        Schema::dropIfExists('installment_payments');
    }
}