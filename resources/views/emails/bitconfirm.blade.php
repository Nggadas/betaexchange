<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation</title>
</head>
<body>
	<p> Dear {!! $user->first_name !!}, </p>
	<p>Your {!! $title !!} has been received.</p>
	

	<p>Confirm order summary:</p>

	<div>

		<b>Date sent: </b> <em>{!! $date_sent !!}</em>
		<br>
		<b>Hash </b> <em>{!! $hash !!}</em>
		<br>
		<b>Amount:</b> <em>{!! $amount_sent !!}</em>
		<br>
		<b>Wallet Address</b> <em>{!! $wallet_id !!}</em>
	</div>

	
	
	
</body>
</html>
