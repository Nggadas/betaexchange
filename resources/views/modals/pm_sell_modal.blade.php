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
              $('#error_msg').html('Your amount sent is lower than expected.');
    
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
            <li style="padding: 5px;" class="active"><a data-toggle="tab" href="#pm_sell_order">{{ $href }}</a></li>
            <li style="padding: 5px;"><a data-toggle="tab" href="#details">Details</a></li>
            <li style="padding: 5px;"><a data-toggle="tab" href="#ac_details">Account Details</a></li>
        </ul>

    </div>

    <div class="tab-content">
      {{-- tab1 --}}
      <div class="tab-pane fade in active" id="pm_sell_order">
        @if (empty($conf_pmsells[0]))
            <form method="post" action="{{route('confirm_sell_pm')}}" role="form">
                {{ csrf_field() }}

              <div class="form-group">
                  <label>Date Sent</label>
                 <input type="date" class="form-control" placeholder="Payment Date(d-m-y)" name="date_sent" id="date_sent" required>
             </div>

             <input type="hidden" name="purchase_id" value="{!! $sold_pm->id !!}">

             <div class="form-group">
                  <label>Batch Number</label>
                 <input type="text" class="form-control" name="batch_number" id="batch_number" placeholder="Enter batch number" required>
             </div>

             <input type="hidden" value="{{ $total }}" id="total">

             <div class="form-group">
                 <label>Amount sent</label>
                 <input type="text" class="form-control" name="amount_sent" id="amount_sent" placeholder="Amount sent" required>
                 <span style="margin-top:15px; margin-left:2px;"  class="text-danger" id="error_msg"></span>
             </div>

             <div class="form-group">
                 <label>PM account no</label>
               <input type="text" class="form-control" name="wallet_id" id="wallet_id" placeholder="Enter your perfect money ac" required>
             </div>

             <div class="form-group">
                <input type="submit" id="submit" name="confirm_btn" value="Submit" class="btn btn-primary">
            </div>

            </form>
        @else

        @if (count($conf_pmsells))
            @foreach ($conf_pmsells as $pm)
                <div class="form-group">
                    <label for="date_sent">Date Sent:</label>
                        <input type="text" name="date_sent" value="{!! $pm->date_sent !!}" class="form-control input-lg" readonly="true">
                </div>      
                <div class="form-group">
                    <label for="details_no">Batch Number:</label>
                        <input type="text" name="details_no" value="{!! $pm->batch_number !!}" class="form-control input-lg" readonly="true">
                </div>  


                <div class="form-group">
                    <label for="amount_paid">Amount Sent:</label>
                        <input type="text" name="amount_paid" value="{!! $pm->amount_sent !!}" class="form-control input-lg" readonly="true">
                </div>

                <div class="form-group">
                    <label for="pm_ac">PM account no:</label>
                        <input type="text" name="pm_ac" value="{!! $pm->pm_account_no !!}" class="form-control input-lg" readonly="true">
                </div>

                
            @endforeach
        @endif
        @endif

      </div>

      {{-- tab2 --}}

      <div class="tab-pane fade" id="details">
          <div class="form-group">
              <label for="ref_no">Reference Number:</label>
                  <input type="text" name="ref_no" value="{!! $sold_pm->ref_no !!}" class="form-control input-lg" readonly="true" >
          </div>  

          <div class="form-group">
              <label for="units">Units:</label>
                  <input type="text" name="units" value="{!! $sold_pm->unit !!}" class="form-control input-lg" readonly="true" >
          </div>

          <div class="form-group">
              <label for="ref_no">Price:</label>
                  <input type="text" name="ref_no" value="{!! $sold_pm->price !!}" class="form-control input-lg" readonly="true" >
          </div>  
      
          <div class="form-group">
              <label for="total">Total:</label>
                  <input type="text" name="total" value="{!! $sold_pm->total !!}" class="form-control input-lg" readonly="true" >
          </div>
          <div class="form-group">
              <label for="status">Status</label>
                <input type="text" name="status" id="" value="{!! $sold_pm->status !!}" class="form-control input-lg" readonly="true">

          </div>

      </div>

      {{--  tab3  --}}
      <div class="tab-pane fade" id="ac_details">
          <div class="form-group">
              <label for="ref_no">Account Name:</label>
                  <input type="text" name="ref_no" value="{!! $sold_pm->account_name !!}" class="form-control input-lg" readonly="true" >
          </div>  

          <div class="form-group">
              <label for="ref_no">Account Number:</label>
                  <input type="text" name="ref_no" value="{!! $sold_pm->account_no !!}" class="form-control input-lg" readonly="true" >
          </div>  

          <div class="form-group">
              <label for="ref_no">Bank Name:</label>
                  <input type="text" name="ref_no" value="{!! $sold_pm->bank_name !!}" class="form-control input-lg" readonly="true" >
          </div>  
      </div>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 0">Close</button>
    </div> 

  </div>

</div>




