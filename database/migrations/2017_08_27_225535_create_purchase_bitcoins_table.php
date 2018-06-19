<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseBitcoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_bitcoins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('phone_no');
            $table->string('email');
            $table->integer('unit');
            $table->integer('price');
            $table->integer('total');
            $table->string('ref_no');
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
        Schema::dropIfExists('purchase_bitcoins');
    }
}
