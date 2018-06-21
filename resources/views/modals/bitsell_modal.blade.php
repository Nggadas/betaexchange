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
                <div class="tab-framed">
                    <ul class="tabs clearfix">
                        <li style="padding: 5px;" class="active"><a href="#confirm_order" data-toggle="tab">{{ $href }}</a></li>
                        <li style="padding: 5px;"><a href="#details" data-toggle="tab">Fund Details</a></li>
                        <li style="padding: 5px;"><a href="#ac_details" data-toggle="tab">Account Details</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    {{-- tab1 --}}
                    <div class="tab-pane fade in active" id="confirm_order">
                            @if (empty($conf_sell_bit[0]))
                                <form method="post" action="{{route('confirm_sell')}}" role="form" id="confirm_sell_bitcoin">
                                        {{csrf_field()}}
                                                                
                                            <div class="form-group">
                                                <label>Date Sent</label>
                                                <input type="date" class="form-control" placeholder="Payment Date(d-m-y)" name="date_sent" id="date_sent" required>
                                            </div>
                            
                                            <div class="form-group">
                                                <label>Transaction ID</label>
                                                <input type="text" class="form-control" name="hash" id="hash" placeholder="1121212" required>
                                            </div>

                                            <input type="hidden" value="{{ $total }}" id="total">
                            
                                            <div class="form-group">
                                                <label>Amount sent</label>
                                                <input type="text" class="form-control" name="amount_sent" id="amount_sent" placeholder="Amount sent" required>
                                                <span style="margin-top:15px; margin-left:2px;"  class="text-danger" id="error_msg"></span>
                                            </div>
                            
                                            <div class="form-group">
                                                <label>Wallet Address</label>
                                            <input type="text" class="form-control" name="wallet_id" id="wallet_id" placeholder="Enter your Wallet Address" required>
                                            </div>
                            
                                            <input type="hidden" name="purchase_id" value="{{$bitsell->id}}">
                                        
                                    <div class="form-group">
                                        <input type="submit" id="submit" name="confirm_btn" value="Submit" class="btn btn-primary">
                                    </div>
                                
                                </form>

                            @else 
                            
                                @if (count($conf_sell_bit))
                                    @foreach ($conf_sell_bit as $bitcoin_sold)
                                    <div class="form-group">
                                        <label for="date_sent">Date Sent:</label>
                                        <input type="text" name="date_sent" value="{{ $bitcoin_sold->date_sent }}" class="form-control input-lg" readonly="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="details_no">Transaction Details:</label>
                                        <input type="text" name="details_no" value="{{ $bitcoin_sold->hash }}" class="form-control input-lg" readonly="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount_paid">Amount Sent:</label>
                                        <input type="text" name="amount_paid" value="{{ $bitcoin_sold->amount_sent }}" class="form-control input-lg" readonly="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="depositor_name">Wallet Address:</label>
                                        <input type="text" name="depositor_name" value="{{ $bitcoin_sold->wallet_id }}" class="form-control input-lg" readonly="true">
                                    </div>


                                    @endforeach

                                @endif
                            


                            @endif

                    </div>

                    {{-- tab2 --}}

                    <div class="tab-pane fade" id="details">
                        
                        <div class="form-group">
                         <label for="ref_no">Reference Number:</label>
                            <input type="text" name="ref_no" value="{!! $bitsell->ref_no !!}" class="form-control input-lg" readonly="true" >
                        </div>  
            
                        <div class="form-group">
                          <label for="wallet_id">Wallet Address:</label>
                            <input type="text" name="wallet_id" value="{!! $bitsell->wallet_id !!}" class="form-control input-lg" readonly="true" >
                        </div>
            
                         <div class="form-group">
                          <label for="units">Units:</label>
                            <input type="text" name="units" value="{!! $bitsell->unit !!}" class="form-control input-lg" readonly="true" >
                         </div>
            
                        <div class="form-group">
                          <label for="total">Total:</label>
                            <input type="text" name="total" value="{!! $bitsell->total !!}" class="form-control input-lg" readonly="true" >
                        </div>
                        <div class="form-group">
                                <label for="phone_no">Transaction Status:</label>
                                  <input type="text" name="phone_no" value="{{ $bitsell->status }}" class="form-control input-lg" readonly="true">
                         </div> 
            

                    </div>


                    {{-- tab 3 --}}

                    <div class="tab-pane fade" id="ac_details">
                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" name="account_name" value="{!! $bitsell->account_name !!}" class="form-control input-lg" readonly="true">
                        </div>

                        <div class="form-group">
                            <label for="account_no">Account Number</label>
                            <input type="text" name="account_no" value="{!! $bitsell->account_no !!}" class="form-control input-lg" readonly="true">
                        </div>

                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" name="bank_name" value="{!! $bitsell->bank_name !!}" class="form-control input-lg" readonly="true">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 0">Close</button>
                </div>   
            </div>

</div>