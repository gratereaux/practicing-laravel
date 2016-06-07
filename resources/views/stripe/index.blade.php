<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf-8">
	<meta name="publishable-key" content="{{ Config::get('stripe.dev_publishable_key') }}">
</head>
<body>

<h1>Pay me 10 Dollars</h1>
	
	{{ Form::open(['id' => 'billing-form']) }}

		<div class="form-row">
			<label>
				<span>Card Number:</span>
				<input type="text" data-stripe="number">
			</label>
		</div>
		<div class="form-row">
			<label>
				<span>CVC:</span>
				<input type="text" data-stripe="cvc">
			</label>
		</div>

		<div class="form-row">
			<label>
				<span>Exp:</span>
				{{ Form::selectMonth(null, null, ['data-stripe' => 'exp-month'])}}
				{{ Form::selectYear(null, date('Y'), date('Y')+7, null, ['data-stripe' => 'exp-year'])}}
			</label>
		</div>
		<div class="form-row">
			<label>
				<span>Email:</span>
				<input type="email" id="email" name="email">
			</label>
		</div>
		<div class="form-row">
			<label>
				<span>One time customer?</span>
				{{ Form::select('onetime', ["yes", "no"]) }}
			</label>
		</div>

		<div class="payment-error" style="display:none;"></div>


		<div>
			{{ Form::submit('Pay me') }}
		</div>
	{{ Form::close() }}

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="/js/billing.js"></script>
</body>
</html>