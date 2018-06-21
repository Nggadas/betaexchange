<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation</title>
</head>
<body>
	<p>Dear {!! $user->first_name !!} </p>

	<p>Your confirmation order has been received. </p>

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
