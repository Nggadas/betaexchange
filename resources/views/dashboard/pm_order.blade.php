@extends('layouts.user_master')

@section('content')
<div class="container">
	<div id="page-wapper">
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Perfect Money</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            @if ($errors->any())
    <div class="alert alert-danger col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	@if (Session::has('message'))
	<div class="alert alert-info text-center" role="alert" style="width:50%;" align="center">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

   {{ Session::get('message') }}
   </div>
   @endif

            <div class="row">
            	<div class="col-md-12">
            		<div class="tabs-framed">
            			<ul class="tabs clearfix">

  							<li style="padding: 5px;" class="active"><a data-toggle="tab" href="#home">Perfect Money Ordered</a></li>
						    <li style="padding: 5px;"><a data-toggle="tab" href="#menu2">Perfect Money Sold </a></li>
 
						</ul>


						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<div class="panel panel-default">
									<div class="panel-heading">
			                           Perfect Money ordered
			                        </div>
			                       
			                        <div class="panel-body">
			                        <table width="100%" class="table table-striped table-bordered table-hover" id="ordered_pm">
			                        	<thead>
			                        		<tr>
			                        			<th>Date</th>
			                        			<th>Ref No</th>
			                        			<th>Units</th>
			                        			<th>Total</th>
			                        			<th>Payment Method</th>
		                                        <th>Status</th>
                                        		<th id="cp">Confirm Payment</th>
                                         		<th id="dd">Delete</th>
			                        		</tr>
			                        	</thead>
			                        	<tbody>
			                        		@if(count($pm))
			                        			@foreach($pm as $pm_order)

			                        				<tr>
			                        					<td>{!! $pm_order->created_at->todatestring() !!}</td>
			                        					<td>{!! $pm_order->ref_no !!}</td>
			                        					<td>{!! $pm_order->unit !!}</td>
			                        					<td>{!! $pm_order->total !!}</td>

			                        					<td>
			                        					@if($pm_order->method == 1)
				                        					Internet Bank Transfer
														@elseif($pm_order->method == 2)
															Bank Deposit
														@elseif($pm_order->method == 3)
															Short Code
														@endif
			                        					</td>                       						
		                        						
		                        						<td>
	                        							{!! $pm_order->status !!}
		                        						</td>

		                        						<td>
														 @if($pm_order->status== "cancelled" && $pm_order->payment_alert == "not sent")
														 <a  id="canel" role="button"   role='button' class='btn btn-danger' data-toggle="modal"  disabled="true">Canelled</a>
														  @elseif($pm_order->status== "cancelled" && $pm_order->payment_alert == "alert sent")
														  <a  id="canel" role="button"   role='button' class='btn btn-danger' data-toggle="modal" disabled="true">Canelled</a>
								                        @elseif($pm_order->payment_alert == "not sent")
														<a role='button' data-edit-id='{!! $pm_order->id!!}' class='btn btn-primary confirm_payment' data-toggle="modal"><i class='fa fa-edit'></i>confirm payment</a>

								                        @elseif($pm_order->payment_alert == "alert sent")    
						                                <a  role='button' id="d2" data-edit-id='{!! $pm_order->id!!}' class='btn btn-primary details confirm_payment' ><i class='fa fa-edit '></i>Details</a>
								                        @endif
		                        						</td>
									                    <td>
															@if ($pm_order->payment_alert == "alert sent")
															<a id="na" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
															@elseif($pm_order->payment_alert == "alert sent" && $pm_order->status == "cancelled")
															<a id="na" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
															@endif

															@if($pm_order->payment_alert == "not sent" && $pm_order->status == "cancelled")
															<a id="na" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
															@elseif($pm_order->payment_alert == "not sent")
									                       <a role="button" data-edit-id='{!! $pm_order->id!!}' class='btn btn-danger deleteBtn' role='button' data-toggle='modal'><i class='fa fa-trash-o fa-lg'></i></a>
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


							<!-- second tab -->

							<div class="tab-pane fade" id="menu2">
								<div class="panel panel-default">
									<div class="panel-heading">
										 Perfect money sold
									</div>

									<div class="panel-body">
										 <table width="100%" class="table table-striped table-bordered table-hover" id="sold_pm">
			                        	<thead>
			                        		<tr>
			                        			<th>Date</th>
			                        			<th>Ref No</th>
			                        			<th>Price</th>
			                        			<th>Units</th>
												<th>Total</th>
												<th>Status</th>
			                        			<th id="cs">Confirm sale</th>
                                         		<th id="ds">Cancel sales</th>
			                        			
			                        		</tr>
			                        	</thead>
			                        	<tbody>
			                        		@if(count($pm_sold))
			                        			@foreach($pm_sold as $pm)
			                        			<tr>
			                        				<td style="width:2%;">{!! $pm->created_at->todatestring() !!}</td>
			                        				<td style="width:2%;">{!!$pm->ref_no !!}</td>
			                        				<td style="width:2%;">{!! $pm->price !!}</td>
			                        				<td style="width:2%;">{!! $pm->unit !!}</td>
													<td style="width:2%;">{!! $pm->total !!}</td>
													<td style="width:2%;">{!! $pm->status !!}</td>
			                        				 <td style="width:2%;">
							                            @if($pm->funding_alert == "not sent" && $pm->status == "cancelled")
														   <a  id="canel2" role="button"   role='button' class='btn btn-danger' data-toggle="modal" data-edit-id="{!! $pm->id !!}" disabled="true">Canelled</a>
														@elseif($pm->funding_alert == "alert sent" && $pm->status == "cancelled")
															<a  id="canel2" role="button"   role='button' class='btn btn-danger' data-toggle="modal" data-edit-id="{!! $pm->id !!}" disabled="true">Canelled</a>
							                            @elseif($pm->funding_alert == "not sent")
														   <a role="button" id="c"  role='button' class='btn btn-primary confirm_sales_payment' data-toggle="modal" data-edit-id="{!! $pm->id !!}"><i class='fa fa-edit'></i>confirm sales</a>
							                            @else    
							                                <a  role="button" id="d"  role='button' data-edit-id='{!! $pm->id !!}' class='btn btn-primary confirm_sales_payment' ><i class='fa fa-edit'></i>Details</a>
							                           @endif
                         							</td>

                         							 <td style="width:2%;">
														@if ($pm->funding_alert == "alert sent")
															<a id="NA" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
														@elseif($pm->funding_alert == "alert sent" && $pm->status == "cancelled")
															<a id="NA" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
														@endif
														@if($pm->funding_alert == "not sent" && $pm->status == "cancelled")
															<a id="NA" href="javascript:void(0)" role="button" class="btn btn-danger" disabled="true">N/A</a>
														@elseif($pm->funding_alert == "not sent")
															  <a role="button" class='btn btn-danger deleteBtn2' role='button' data-toggle='modal' data-edit-id="{!! $pm->id !!}"><i class='fa fa-trash-o fa-lg'></i></a>
														
							                            @endif
                        							</td>
			                        			</tr>
			                        			@endforeach
			                        		@endif
			                        	</tbody>
			                        </table>
									</div>
								</div>
							</div>

							
							<!-- end of second tab -->
						</div>
						<!-- end of tab content -->

            		</div>
            		<!-- end of tabs frames -->
            	</div>
            	<!-- col -->
            </div>
            <!-- row -->
	</div>

<!-- confirm_sold_payment -->
<div class="modal fade" id="conf_sold_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  id="sold_modal_body">
     
    </div>
</div>
<!-- view buy_pm details -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  id="view_modal_body">
     
    </div>
</div>

<!-- view conf_sold details -->
<div class="modal fade" id="buy_pm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  id="pm_body">
     
    </div>
</div>

{{-- @include('modals.delete_modal') --}}

	
</div>


@endsection
@section('script')
    <script type="text/javascript">
        $(function () {

			


			
       

              $('#ordered_pm').DataTable({
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


                $('#sold_pm').DataTable({
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

		$(".confirm_payment").click(function () {

            $("#view_modal_body").load("confirm_buypm/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#view_modal").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                               // bindForm(this);
                });
            return false;
         });

               

                $(".confirm_sales_payment").click(function () {

            $("#sold_modal_body").load("confirm_sold/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#conf_sold_modal").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                               // bindForm(this);
                });
            return false;
         });
			 
		 
		 $(".deleteBtn2").click(function () {

            $("#sold_modal_body").load("delete_soldpm/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
                     $("#conf_sold_modal").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                               // bindForm(this);
                });
            return false;
		 });
		 
		 $(".deleteBtn").click(function () {

            $("#sold_modal_body").load("delete_buypm/" + $(this).data("edit-id"),function(responseTxt, statusTxt, xh)
                {
					
                     $("#conf_sold_modal").modal({
                                    backdrop: 'static',
                                    keyboard: true
                                }, "show");
                               // bindForm(this);
                });
            return false;
         });


                




        });

        </script>
@stop