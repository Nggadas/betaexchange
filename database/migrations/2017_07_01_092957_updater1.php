<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Updater1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_details', function (Blueprint $table) {
             $table->renameColumn('account_name', 'account_first_name');
             $table->string('account_middle_name')->nullable();
             $table->string('account_last_name');
             $table->integer('secret_question');
             $table->string('secret_answer');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_details', function (Blueprint $table) {
            //
        });
    }
}
