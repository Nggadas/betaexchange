<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmBuyPmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_buy_pms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('date_sent');
            $table->string('details_no');
            $table->integer('amount_paid');
            $table->string('depositor_name');
            $table->string('receipt_dir');
            $table->integer('perfect_money_id');
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
        Schema::dropIfExists('confirm_buy_pms');
    }
}
