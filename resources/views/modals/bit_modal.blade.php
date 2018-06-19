<div class="modal-content">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>

  <div class="modal-body">
    <div class="tabs-framed">
        <ul class="tabs clearfix">
            <li style="padding: 5px;" class="active"><a data-toggle="tab" href="#confirm_order">{{ $href }}</a></li>
            <li style="padding: 5px;"><a data-toggle="tab" href="#details">Order Details</a></li>
          </ul>
    </div>
    <div class="tab-content">
      <div id="confirm_order" class="tab-pane fade in active">
        @if (empty($conf_buy[0]))
        <form method="post" action="{{route('confirm_bitcoin')}}" role="form" enctype="multipart/form-data" id="confirm_buy_bitcoin">
          {{csrf_field()}}
        
              <div class="form-group">
                  <label>Date Sent</label>
                  <input type="date" class="form-control"  name="date" id="date" format="dd/MM/yyyy" placeholder="dd/mm/yyyy"> 
              </div>
              <div class="form-group">
                  <label>Transfer Details</label>
                  <input type="text" class="form-control" name="details_no" id="details_no" placeholder="eg:memo/teller_no/transfer-ref_no">
              </div>

              <div class="form-group">
                  <label>Amount Paid</label>
                  <input type="text" class="form-control" name="amount_paid" id="amount_paid" placeholder="Amount paid">
              </div>

              <div class="form-group">
                  <label>Depositor Name</label>
                <input type="text" class="form-control" name="depositor_name" id="depositor_name" placeholder="eg:john eze">
              </div>

              <input type="hidden" name="purchase_id" value="{{$buy_details->id}}">
                          
              <div class="form-group">
                <label>Upload Receipt(2mb JPG,PNG,PDF format only)</label>
                <input type="file" name="receipt_dir">
              </div>

              <div class="form-group">
                      <input type="submit" name="confirm_btn" value="submit" class="btn btn-primary">
              </div>
      </form>
          @else
          @if (count($conf_buy))
          @foreach ($conf_buy as $bitcoin)
          
              <div class="form-group">
                  <label for="date_sent">Date Sent:</label>
                  <input type="text" name="date_sent" value="{{ $bitcoin->date_sent }}" class="form-control input-lg" readonly="true">
              </div>
              <div class="form-group">
                  <label for="details_no">Memo/teller-no /transfer ref-no:</label>
                  <input type="text" name="details_no" value="{{ $bitcoin->transfer_details }}" class="form-control input-lg" readonly="true">
              </div>
              <div class="form-group">
                  <label for="amount_paid">Amount Paid:</label>
                  <input type="text" name="amount_paid" value="{{ $bitcoin->amount_paid }}" class="form-control input-lg" readonly="true">
              </div>
              <div class="form-group">
                  <label for="depositor_name">Depositor Name:</label>
                  <input type="text" name="depositor_name" value="{{ $bitcoin->depositor_name }}" class="form-control input-lg" readonly="true">
              </div>
              <div class="form-group">
                <label for="image">Receipt Uploaded:</label>
                <img src="{{ url('/receipt_uploads')}}/{{ $bitcoin->receipt_dir  }}" alt="uploaded receipt" >
                
              </div>
          
         
          @endforeach
          @endif
        @endif
          

      </div>

      {{--  tab2  --}}
      <div id="details" class="tab-pane fade">
          <div class="form-group">
              <label for="ref_no">Reference Number:</label>
          <input type="text" name="ref_no" value="{!! $buy_details->ref_no !!}" class="form-control input-lg" readonly="true" >
          </div>  

          <div class="form-group">
            <label for="wallet_id">Wallet ID:</label>
              <input type="text" name="wallet_id" value="{!! $buy_details->wallet_id !!}" class="form-control input-lg" readonly="true" >
          </div>

           <div class="form-group">
            <label for="units">Units:</label>
              <input type="text" name="units" value="{!! $buy_details->unit !!}" class="form-control input-lg" readonly="true" >
           </div>

          <div class="form-group">
            <label for="total">Total:</label>
              <input type="text" name="total" value="{!! $buy_details->total !!}" class="form-control input-lg" readonly="true" >
          </div>


      <div class="form-group">
          <label for="email">Payment Method:</label>
          @if($buy_details->method == 1)
          <input type="email" name="unit" value="Internet Bank Transfer" class="form-control input-lg" readonly="true" >
                
           @elseif($buy_details->method == 2)
           <input type="email" name="unit" value="Bank Deposit" class="form-control input-lg" readonly="true" >
                        
            @elseif($buy_details->method == 3)
             <input type="email" name="unit" value="Short Code" class="form-control input-lg" readonly="true" >
            @endif
      </div>
      <div class="form-group">
          <label for="phone_no">Transaction Status:</label>
            <input type="text" name="phone_no" value="{{ $buy_details->status }}" class="form-control input-lg" readonly="true">
          </div> 
      </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 0">Close</button>
      </div>   

     
  </div>


</div>

   