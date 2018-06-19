<script>
    $('#custom_status').hide();

    $('#payment_options').change(function() {
        if ($(this).val() === '4') {
            if($('#custom_status').css('display') == 'none'){ 
                $('#custom_status').css('display') == 'inline';
                $('#custom_status').show(); 

            } else {
                $('#custom_status').css('display') == 'none';
                $('#custom_status').hide(); 
            }
        }else{
            $('#custom_status').hide();
        }
    });
    
    $('#submit').click(function() {
        $('#submit').text("Please Wait...");
        $('#submit').attr('disabled', 'disabled');
        $('#submit').submit();
    });
</script>

<div class="modal-content">
@if(isset($bitcoin))
     {!! Form::model($bitcoin, array('route' => array('sell.update', $bitcoin->id), 'method' => 'PUT')) !!}
@else
    {!! Form::open(array('url' => '/administrator/sell')) !!}
@endif

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{!! $page_title !!} Order</h4>
        </div>
        <div class="modal-body">
          <div class="tabs-framed">
          <ul class="tabs clearfix">

  <li style="padding: 5px;" class="active"><a data-toggle="tab" href="#tab1">Company Account</a></li>
  <li style="padding: 5px;"><a data-toggle="tab" href="#tab2">Order Details</a></li>
  <li style="padding: 5px;"><a data-toggle="tab" href="#tab3">Funding Details</a></li>
 
  </ul>
  <div class="tab-content">

  <div id="tab1" class="tab-pane fade in active">


    @foreach($bank_details as $account)

      <div class="form-group">
        <label for="wallet_id">Wallet Address:</label>
        <input type="text" name="wallet_id" value="{{ $account->wallet_id }}" class="form-control input-lg" readonly="true" >
      </div>


    @endforeach 


  </div>

  <div id="tab2" class="tab-pane fade">

      <div class="form-group">
          <label for="date">Date</label>
          <input type="text" name="date" value="{{ $bitcoin->created_at->todatestring() }}" class="form-control input-lg" readonly="true">
      </div>  

      <div class="form-group">
          <label for="ref_no">Reference Number</label>
          <input type="text" name="ref_no" value="{{ $bitcoin->ref_no }}" class="form-control input-lg" readonly="true">
      </div> 

      <div class="form-group">
          <label for="time">Time</label>
          <input type="text" name="time" value="{{ $bitcoin->created_at->totimestring() }}" class="form-control input-lg" readonly="true">
      </div>  

      <div class="form-group">
        <label for="account_name">Account Name:</label>
        <input type="text" name="account_name" value="{{ $bitcoin->account_name }}" class="form-control input-lg" readonly="true" >
      </div>

      <div class="form-group">
        <label for="account_no">Account Number:</label>
        <input type="text" name="account_no" value="{{ $bitcoin->account_no }}" class="form-control input-lg" readonly="true" >
      </div>

      <div class="form-group">
        <label for="bank_name">Bank Name:</label>
        <input type="text" name="bank_name" value="{{ $bitcoin->bank_name }}" class="form-control input-lg" readonly="true" >
      </div>


      <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" value="{{ $bitcoin->email }}" class="form-control input-lg" readonly="true" >
      </div>

      <div class="form-group">
          <label for="phone_no">Phone No:</label>
          <input type="text" name="phone_no" value="{{ $bitcoin->phone_no }}" class="form-control input-lg" readonly="true">
      </div>

      <div class="form-group">
          <label for="units">Units:</label>
          <input type="text" name="units" value="{{ $bitcoin->unit }}" class="form-control input-lg" readonly="true">
      </div>

      <div class="form-group">
          <label for="price">Price:</label>
          <input type="text" name="price" value="{{ $bitcoin->price }}" class="form-control input-lg" readonly="true">
      </div>

      <div class="form-group">
          <label for="total">Total:</label>
          <input type="text" name="total" value="{{ $bitcoin->total }}" class="form-control input-lg" readonly="true">
      </div>

      <div class="form-group">
          <label for="order_status">Order Status:</label>
          <input type="text" name="order_status" value="{{ $bitcoin->status }}" class="form-control input-lg" readonly="true">
      </div> 

      <div class="form-group" style="margin-top: 25px;"> 
          <label for="status">Process Order:</label>
          {!! Form::select('status',$payment_status, Input::old('status'),['class' => ' btn btn-default btn-lg',
          'required' => "true",'tabindex'=>"5", 'id'=>"payment_options"]) !!}
      </div>

      <div class="form-group" style="margin-top: 25px;">
          <input style="width:300px; height:35px" type="text" id="custom_status" name="custom_status">
      </div>
  </div>

  <div id="tab3" class="tab-pane fade">
    @if(!empty($fund_details[0]))
        <div class="form-group">
            <label for="date_sent">Date Sent:</label>
            <input type="text" name="date_sent" value="{{ $fund_details[0]->date_sent }}" class="form-control input-lg" readonly="true" >
        </div>
        <div class="form-group">
            <label for="transaction_id">Transaction ID:</label>
            <input type="text" name="transaction_id" value="{{ $fund_details[0]->hash }}" class="form-control input-lg" readonly="true" >
        </div>
        <div class="form-group">
            <label for="amount_sent">Amount Sent:</label>
            <input type="text" name="amount_sent" value="{{ $fund_details[0]->amount_sent }}" class="form-control input-lg" readonly="true" >
        </div>
        <div class="form-group">
            <label for="wallet_address">Wallet Address:</label>
            <input type="text" name="wallet_address" value="{{ $fund_details[0]->wallet_id }}" class="form-control input-lg" readonly="true" >
        </div>
    @else
        <div class="form-group">
            Funding alert has not been sent.
        </div>
    @endif
  </div>

</div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="submit" class="btn btn-primary">{!! $page_action !!}</button>

        </div>
   {!! Form::close() !!}
</div>
</div>