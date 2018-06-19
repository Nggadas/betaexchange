<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameConfirmSellPmsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('confirm_sell_pms' , function(Blueprint $table) {
            $table->renameColumn('wallet_id', 'pm_account_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('confirm_sell_pms' , function(Blueprint $table) {
            $table->renameColumn('wallet_id', 'pm_account_no');
        });
    }
}
