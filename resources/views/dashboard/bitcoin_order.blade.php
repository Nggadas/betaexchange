@extends('layouts.user_master')

@section('content')
<!--header end here-->
<!--about start here-->
<div class="container">
  

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bitcoin</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            @if ($errors->any())
    <div class="alert alert-danger ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                  <div class="tabs-framed">

  <ul class="tabs clearfix">


  <li style="padding: 5px;" class="active"><a data-toggle="tab" href="#home">Buy Bitcoin</a></li>
  <li style="padding: 5px;"><a data-toggle="tab" href="#menu2">Sell Bitcoin</a></li>
 
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
                         
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bitcoin
                        </div>
                       

                        
                        

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="bitcoin">
                               <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ref No</th>
                                        <th>Wallet ID</th>
                                        <th>Units</th>
                                        <th>Total</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th width="5%">Confirm payment</th>
                                         <th width="5%">Delete</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @if (count($bitcoins))
                             @foreach ($bitcoins as $bitcoin)
                        <tr>
                       
                         <td>
                         {!! $bitcoin->created_at->todatestring() !!}
                        </td>
                        <td>
                          {!! $bitcoin->ref_no !!}
                        </td>

                        <td>
                         {!! $bitcoin->wallet_id !!}
                        </td>
                        <td>
                         {!! $bitcoin->unit !!}
                        </td>
                          <td>
                           {!! $bitcoin->total !!}
                        </td>

                        <td>
                          @if($bitcoin->method == 1)
                          Internet Bank Transfer
                          @elseif($bitcoin->method == 2)
                          Bank Deposit
                          @elseif($bitcoin->method == 3)
                          Short Code
                          @endif
                        </td>

                         <td>
                           {{ $bitcoin->status }}
                         </td>
                         <td>
                            @if ($bitcoin->payment_alert == "not sent" && $bitcoin->status == "cancelled")
                            <a  id="cancel" role='button'  class='btn btn-danger canel' disabled="true" >Cancelled</a>
                            @elseif($bitcoin->payment_alert == "alert sent" && $bitcoin->status == "cancelled")
                            <a  id="cancel" role='button'  class='btn btn-danger canel' disabled="true" >Cancelled</a>
                           @elseif ($bitcoin->payment_alert == "not sent")
                            <a id="confirm_payment"  role='button' data-edit-id='{!! $bitcoin->id!!}' class='btn btn-primary confirm_payment' data-toggle="modal"><i class='fa fa-edit'>Confirm payment</i>
                            </a>
                            @elseif($bitcoin->payment_alert == "alert sent")
                            <a id="detail" role='button' data-edit-id='{!! $bitcoin->id!!}' class='btn btn-primary  confirm_payment' data-toggle="modal"><i class='fa fa-edit'>Details</i>
                            </a>
                            
                           @endif
                         </td>
                        <td id="del">
                            @if ($bitcoin->payment_alert == "alert sent")
                                <label id="na" class="btn btn-danger" disabled="true">N/A</label>
                            @elseif($bitcoin->payment_alert == "alert sent" && $bitcoin->status == "cancelled")
                                <label id="na" class="btn btn-danger" disabled="true">N/A</label>
                            @endif
                                
                            @if($bitcoin->payment_alert == "not sent" && $bitcoin->status == "cancelled")
                                <label id="na" class="btn btn-danger" disabled="true">N/A</label>
                            @elseif($bitcoin->payment_alert =="not sent" )
                                <a  data-edit-id='{!! $bitcoin->id!!}' class='btn btn-danger deleteBtn' role='button' data-toggle='modal'><i class='fa fa-trash-o fa-lg'></i></a>
                            @endif
                        </td>
                    </tr>

                @endforeach
                         
                           @endif

                                </tbody>
                            </table>
                         
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>



                    <!-- menu2 -->
                      <div id="menu2" class="tab-pane fade">
                          <div class="panel panel-default">
                        <div class="panel-heading">
                           Bitcoin Sold 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="sold_bitcoins">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Wallet Address</th>
                                        <th>Units</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th width="5%" id="cp">Confirm payment</th>
                                         <th width="5%" id="delete">Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($sold_bitcoins))
                             @foreach ($sold_bitcoins as $bitcoins)
                    <tr> 
                       
                         <td>
                          {!! $bitcoins->created_at->todatestring() !!}
                        </td>
                        
                         <td>
                          {!! $bitcoins->wallet_id !!}
                        </td>
                        <td>
                          {!! $bitcoins->unit !!}
                        </td>
                        <td>
                          {!! $bitcoins->price !!}
                        </td>
                        <td>
                          {!! $bitcoins->total !!}
                        </td>
                        <td>{!! $bitcoins->status !!}</td>
                         <td>
                            @if ($bitcoins->funding_alert == "not sent" && $bitcoins->status == "Canceled")
                                <a  id="cancel" role='button'  class='btn btn-danger canel' disabled="true" >Cancelled</a>
                                
                            @elseif($bitcoins->funding_alert == "alert sent" && $bitcoins->status=="Canceled")
                                <a  id="cancel" role='button'  class='btn btn-danger canel' disabled="true" >Cancelled</a>
                            @elseif($bitcoins->funding_alert == "not sent")
                                <a id="confirm2"   role='button' data-edit-id='{!! $bitcoins->id!!}' class='btn btn-primary confirm_bit_sell' data-toggle="modal"><i class='fa fa-edit'></i>confirm fund</a>
                            @elseif($bitcoins->funding_alert == "alert sent")    
                                <a id="details2"  role='button' data-edit-id='{!! $bitcoins->id!!}' class='btn btn-primary confirm_bit_sell' ><i class='fa fa-edit'></i>Details</a>
                           @endif
                        </td>
                        <td id="delrow">
                            @if ($bitcoins->funding_alert == "alert sent")
                                <label class="btn btn-danger" disabled="true">N/A</label>
                            @elseif($bitcoins->funding_alert == 'alert sent' && $bitcoins->status == 'cancelled')
                                <label id="na" class="btn btn-danger" disabled="true">N/A</label>
                            @endif
                            @if($bitcoins->funding_alert == "not sent" && $bitcoins->status == "cancelled")
                                <label id="na" class="btn btn-danger" disabled="true">N/A</label>
                            @elseif($bitcoins->funding_alert == "not sent")
                                <a href='' data-edit-id='{!! $bitcoins->id!!}' class='btn btn-danger deleteBtn2' role='button' data-toggle='modal'><i class='fa fa-trash-o fa-lg'></i></a>
                            @endif
                        </td>
                       
                    </tr>

                @endforeach
                         
                           @endif

                                </tbody>
                            </table>
                         
                        </div>
                        <!-- /.panel-body -->
                    </div>
                      </div>
                    </div>
                    <!-- /.panel -->
                </div>
              </div>
                <!-- /.col-lg-12 -->
            </div>


            <!-- /.row -->
        </div>

  <!-- buy bitcoins details modal -->
 <div class="modal fade" id="view_modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  id="view_modal_body2">
     
    </div>
</div>


<!-- sell bitcoins details modal -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  id="view_modal_body">
     
    </div>
</div>

        {{-- @include('modals.bitcoins_modals')
        @include('modals.bitcoin_sell_modal') --}}

</div>

@endsection
@section('script')
<!-- <script src="{{asset('js/confirm_sell_bitcoin.js')}}"></script> -->
    <script type="text/javascript">
        $(function () {

           

            
          

              $('#bitcoin').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                             "responsive":true,
                            "info": true,
                            "autoWidth": true,
                            "order": [[0, "desc"]],
                            dom: 'Bfltip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });


                $('#sold_bitcoins').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                             "responsive":true,
                            "info": true,
                            "autoWidth": true,
                            "order": [[0, "desc"]],
                            dom: 'Bfltip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });

                        //load modal for sell bitcoin
                 $(".confirm_bit_sell").click(function () {

            $("#view_modal_body").load("load_confirmbitsell/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#view_modal").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                               // bindForm(this);
                });
            return false;
         });

               
               

              
               

                //load modal for buy bitcoin
                $(".confirm_payment").click(function () {

            $("#view_modal_body2").load("confirm_bit/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#view_modal2").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                                //bindForm(this);
                });
            return false;
         });


         //delete buy bitcoin
         $(".deleteBtn").click(function () {

            $("#view_modal_body2").load("delete_buybitcoin/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#view_modal2").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                                //bindForm(this);
                });
            return false;
         });


         //delete sold bitcoin
         $(".deleteBtn2").click(function () {

            $("#view_modal_body2").load("delete_soldbitcoin/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#view_modal2").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                                //bindForm(this);
                });
            return false;
         });








        });

        </script>
@stop