<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirm_sell_pm extends Model
{
    protected $fillable = ['user_id','date_sent', 'batch_number', 'amount_sent', 'pm_account_no', 'purchase_perfect_money_id'];
}
