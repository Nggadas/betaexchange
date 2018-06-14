<!DOCTYPE html>
<html>
<head>
	<title>Sell Perfect</title>
</head>
<body>
<h4>This User <b>{!! $account_name!!}</b> with the phone number <b>{!! $phone_no !!}</b> will love to sell {!! $units !!} units of {{ $ctype }}, to us. Please take care of the order as soon as possible.</h4>
<br>

<h3>Details are as follows</h3>

<h4>Account Name: {!! $account_name !!}</h4>
<h4>Bank Name: {!! $bank_name !!}</h4>
<h4>Phone No: {!! $phone_no !!}</h4>
<h4>Email: {!! $user->email !!}</h4>
<h4>Units: {!! $units !!}</h4>
<h4>Price: {!! $price !!}</h4>
<h4>Total: {!! $total_units !!}</h4>

<br>
<br>
<br>
<h5>Thanks Mgt</h5>
</body>
</html>
