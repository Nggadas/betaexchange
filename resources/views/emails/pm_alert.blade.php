<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation</title>
</head>
<body>
	<p> {!! $user->first_name !!}  {!! $user->middle_name !!} {!! $user->last_name !!}</p>

	<p>Just Confirmed his/her Perfect Money order, please response </p>

	<p>Confirm order summary:</p>

	<div>
		<b>Date Paid: </b> <em>{!! $date !!}</em>
		<br>
		<b>Payment detail: </b> <em>{!! $details_no !!}</em>
		<br>
		<b>Amount Paid (₦): </b> <em>{!! $amount_paid !!}</em>
		<br>
		<b>Depositor Name:</b> <em>{!! $depositor_name !!}</em>
	</div>

	
	
	
</body>
</html>
