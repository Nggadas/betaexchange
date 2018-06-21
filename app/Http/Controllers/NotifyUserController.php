<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifyUser;
use App\Models\BitCoin;
use App\Models\PerfectMoney;
use App\Models\PurchaseBitCoin;
use App\Models\PurchasePerfectMoney;
use App\Confirm_sell_bitcoin;
use App\Confirm_sell_pm;
use App\Confirm_buy_bitcoins;
use App\Confirm_buy_pm;


class NotifyUserController extends Controller
{
    public function Viewmsg($id) {
    	$msg = notifyUser::find($id);
    	//dd($msg);
    	 $data['page_title']="Confirm Alert";
    	 $data['msg'] = notifyUser::find($id);

    	 return view('modals.message_modal',$data);

    }


    public function delete_msg($id) {

    	$order = notifyUser::find($id);

    	$order->delete();
         return redirect()->back()->with(['message' =>'Successfully deleted!']);
    }


    // for loading confirm pm sold
    public function confirm_sold($id) {
        $perfect_money = PurchasePerfectMoney::find($id);
        $data['sold_pm'] = $perfect_money;
        $data['total'] = $perfect_money->total;
        $conf_pmsells = Confirm_sell_pm::where('purchase_perfect_money_id', $id)->get();
        if(empty($conf_pmsells[0])) {
            $a = "Confirm Fund";
        } else {
            $a = "Confirmation Details";

        }
        $data['href'] = $a;
        $data['conf_pmsells'] = Confirm_sell_pm::where('purchase_perfect_money_id', $id)->get();
        return view('modals.pm_sell_modal', $data);
    }

    
    // for loading confirm buy pm
     public function Confirm_buypm($id) {
        $perfect_money = PerfectMoney::find($id);
        $data['pm'] = $perfect_money;
        $data['total'] = $perfect_money->total;
        $conf_buypm = Confirm_buy_pm::where('perfect_money_id', $id)->get();
        if(empty($conf_buypm[0])) {
            $a = "Confirm Payment";
        } else {
            $a = "Confrimation Details";
        }

        $data['href'] = $a;
        $data['conf_buypm'] = Confirm_buy_pm::where('perfect_money_id', $id)->get();
        //dd($data);
        return view('modals.pm_modals', $data);
    }

    //for loading confirm buy bitcoin
    public function confirm_bit($id) {
       
        $bitcoin = BitCoin::find($id);
        $data['buy_details'] = $bitcoin;
        $data['total'] = $bitcoin->total;
        $conf_details = Confirm_buy_bitcoins::where('bitcoin_id', $id)->get();
        if (empty($conf_details[0])) {
            $a = "Confirm Payment";
        } else {
            $a = "Payment details";
        }
        $data['href'] = $a;
        $data['conf_buy'] = Confirm_buy_bitcoins::where('bitcoin_id', $id)->get();
        
        return view('modals.bit_modal', $data);
    }

    //for loading confirm bitcoin sold
     public function load_confirmbitsell($id) {
        $bitcoin = PurchaseBitCoin::find($id);
        $data['bitsell'] = $bitcoin;
        $data['total'] = $bitcoin->total;
        $conf_details = Confirm_sell_bitcoin::where('purchase_bitcoins_id', $id)->get();
        if(empty($conf_details[0])) {
            $a = "Confirm Fund";
        } else {
            $a = "Confirmation Details";
        }
        $data['href'] = $a;
        $data['conf_sell_bit'] = Confirm_sell_bitcoin::where('purchase_bitcoins_id', $id)->get();
        return view('modals.bitsell_modal', $data);
    }
    
    //view the delete modal
    public function delete_soldPM($id) {
         $data['soldpm'] = PurchasePerfectMoney::find($id);

         return view('modals.delete_soldPM', $data);
        
        
    }

    //view the delete buymodal
    public function delete_BuyPM($id) {
         $data['buypm'] = PerfectMoney::find($id);

         return view('modals.delete_buyPM', $data);

    }

    //view the delete buybitcoin
    public function delete_Buybitcoin($id) {
        $data['buybitcoin'] = Bitcoin::find($id);

        return view('modals.delete_buyBitcoin', $data);

    }

    public function delete_Soldbitcoin($id) {
        $data['soldbitcoin'] = PurchaseBitcoin::find($id);

        return view('modals.delete_soldBitcoin', $data);
    }

    //delete the soldpm 
    public function delete_sold_pm($id) {
        $data = PurchasePerfectMoney::find($id);
       $data->status = "cancelled";
       $data->save();
      
       return redirect()->back()->with(['message' =>'Successfully Cancelled!']);
    }

    //delete the buypm
    public function delete_buy_pm($id){
        $data = PerfectMoney::find($id);
        $data->status = "Canceled";
        $data->save();
      
        return redirect()->back()->with(['message' =>'Successfully Cancelled!']);
    }

    public function delete_buy_bit($id) {
        $data = Bitcoin::find($id);
        $data->status = "Canceled";
        $data->save();

        return redirect()->back()->with(['message' =>'Successfully Cancelled!']);
    }

    public function delete_sold_bit($id) {
        $data = PurchaseBitcoin::find($id);
        $data->status = "Canceled";
        $data->save();

        return redirect()->back()->with(['message' =>'Successfully Cancelled!']);

    }

   
}
