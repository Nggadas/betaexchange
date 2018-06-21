<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableConfirmBuyPmsChangeReceiptDir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirm_buy_pms', function (Blueprint $table) {
            $table->string('receipt_dir')->nullable()->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confirm_buy_pms', function (Blueprint $table) {
            $table->dropColumn('receipt_dir');
        });
    }
}
