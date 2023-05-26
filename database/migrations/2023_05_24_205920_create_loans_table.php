<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->date('loan_date');
            $table->text('loan_purpose');
            $table->text('loan_amount');
            $table->char('long_installment', 2);
            $table->text('installment_amount');
            $table->char('account_number', 10);
            $table->string('attachment_kk');
            $table->string('attachment_ktp_orang_tua');
            $table->string('attachment_ktp_mahasiswa');
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
        Schema::dropIfExists('loans');
    }
}
