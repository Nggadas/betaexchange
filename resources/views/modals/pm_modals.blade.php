<script>
    $('#error_msg').hide();
	
    $('#amount_sent').on('keyup', function (){
        var total = parseInt($('#total').val());
        var amount_sent = parseInt($('#amount_sent').val());

        console.log(total);
        console.log(amount_sent);
        
        if(amount_sent < total){
          $(this).css('border-color', 'red');
          $('#submit').attr('disabled', true);
          $('#error_msg').show();
          $('#error_msg').html('Your amount paid is lower than expected.');

        }else if(amount_sent >= total){
          $(this).css('border-color', 'green');
          $('#submit').attr('disabled', false);
          $('#error_msg').hide();
        }else{
          $(this).css('border-color', 'red');
          $('#submit').attr('disabled', true);
          $('#error_msg').show();
          $('#error_msg').html('Enter the amount sent.');
        }
    });
</script>

<div class="modal-content">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>

  <div class="modal-body">
    <div class="tabs-framed">
        <ul class="tabs clearfix">
            <li style="padding: 5px;" class="active"><a data-toggle="tab" href="#confirm_order">{{ $href }}</a></li>
            <li style="padding: 5px;"><a data-toggle="tab" href="#details">Order Details</a></li>
            <li style="padding: 5px;"><a href="#ac_details" data-toggle="tab">Account Details</a></li>
          </ul>
    </div>

    <div class="tab-content">
      {{--  tab1  --}}
      <div class="tab-pane fade in active" id="confirm_order">
        @if (empty($conf_buypm[0]))
        <form method="post" action="{{route('confirm_pm')}}" role="form" enctype="multipart/form-data" id="confirm_buy_bitcoin">
          {{csrf_field()}}
          <div class="form-group">
            <label>Date</label>
           <input type="date" class="form-control" placeholder="Payment Date(d-m-y)" name="date" id="date" required>
          </div>

          <div class="form-group">
            <label>Transfer Details</label>
           <input type="text" class="form-control" name="details_no" id="details_no" placeholder="eg:memo/teller_no/transfer-ref_no" required>
          </div>

          <input type="hidden" value="{{ $total }}" id="total">

          <div class="form-group">
            <label>Amount Paid</label>
            <input type="text" class="form-control" name="amount_paid" id="amount_sent" placeholder="Amount paid" required>
            <span style="margin-top:15px; margin-left:2px;"  class="text-danger" id="error_msg"></span>
          </div>

          <div class="form-group">
            <label>Depositor Name</label>
          <input type="text" class="form-control" name="depositor_name" id="depositor_name" placeholder="eg:john eze" required>
        </div>

        <input type="hidden" name="purchase_id" value="{{$pm->id}}">
            
          
          <div class="form-group">
            <label>Upload Receipt(2mb JPG,PNG,PDF format only)</label>
            <input type="file" name="receipt_dir">
          </div>
        

        <div class="form-group">
            <input type="submit" id="submit" name="confirm_btn" value="OK" class="btn btn-primary">
        </div>



          @else


          @if (count($conf_buypm))
             @foreach ($conf_buypm as $buypm)
                <div class="form-group">
                  <label for="date_sent">Date Sent:</label>
                    <input type="text" name="date_sent" value="{!!$buypm->date_sent !!}" class="form-control input-lg" readonly="true">
                </div>  
                
                
                <div class="form-group">
                  <label for="details_no">Memo/teller-no /transfer ref-no:</label>
                    <input type="text" name="details_no" value="{!!$buypm->details_no !!}" class="form-control input-lg" readonly="true">
                </div>  


                <div class="form-group">
                  <label for="amount_paid">Amount Paid:</label>
                    <input type="text" name="amount_paid" value="{!!$buypm->amount_paid !!}" class="form-control input-lg" readonly="true">
                </div>

                <div class="form-group">
                  <label for="depositor_name">Depositor Name:</label>
                    <input type="text" name="depositor_name" value="{!!$buypm->depositor_name !!}" class="form-control input-lg" readonly="true">
                </div>

                <div class="form-group">
                      <label for="image">Receipt Uploaded:</label>
                      @if(!empty($buypm->receipt_dir))
                      <img src="{{ url('/pm_receipt_uploads')}}/{{ $buypm->receipt_dir}}" alt="{{$buypm->receipt_dir}}"> 
                      @else
                          <span style="color: #f44842;">No Receipt uploaded</span>
                      @endif
                </div>


            @endforeach
          @endif
            
        @endif

      </div>

      {{--  tab2  --}}
      <div class="tab-pane fade" id="details">
          <div class="form-group">
              <label for="ref_no">Reference Number:</label>
                <input type="text" name="ref_no" value="{!! $pm->ref_no !!}" class="form-control input-lg" readonly="true" >
          </div>

          <div class="form-group">
            <label for="units">Units:</label>
              <input type="text" name="units" value="{!! $pm->unit !!}" class="form-control input-lg" readonly="true">
          </div>

          <div class="form-group">
              <label for="total">Total:</label>
                <input type="text" name="total" value="{!! $pm->total !!}" class="form-control input-lg" readonly="true">
            </div>

            <div class="form-group">
                <label for="payment">Payment Method:</label>
                @if($pm->method == 1)
                <input type="text" name="payment_method" value="Internet Bank Transfer" class="form-control input-lg" readonly="true" >
                      
                 @elseif($pm->method == 2)
                 <input type="text" name="payment_method" value="Bank Deposit" class="form-control input-lg" readonly="true" >
                              
                  @elseif($pm->method == 3)
                   <input type="text" name="payment_method" value="Short Code" class="form-control input-lg" readonly="true" >
                  @endif
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <input type="text" name="status" value="{!! $pm->status !!}" class="form-control input-lg" readonly="true">

            </div>


    
  
      </div>

      <div class="tab-pane fade" id="ac_details">

          <div class="form-group">
              <label for="account_name">Account Name</label>
              <input type="text" name="account_name" value="{!! $pm->account_name !!}" class="form-control input-lg" readonly="true">
            </div>

            <div class="form-group">
                <label for="account_no">Account Number</label>
                <input type="text" name="status" value="{!! $pm->account_no !!}" class="form-control input-lg" readonly="true">
  
              </div>
        

      </div>



    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 0">Close</button>
      </div>

  </div>

</div>