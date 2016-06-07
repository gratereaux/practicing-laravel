<?php

namespace App\Billing;

use Config;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error\Card;


class StripeBilling implements BillingInterface{

	public function __construct(){

		Stripe::setApiKey(Config::get('stripe.dev_secret_key'));

	}

	public function charge(array $data){

		try{

			if ($data['onetime'] == 1 ){
				
				$customer = Customer::Create([
					'source' => $data['token'],
					'description' => 'name',
					'email' => $data['email']
				]);
			
				$charged = Charge::create([
					'customer' => $customer->id,
					'amount' => 1000, //10 Dollars
					'currency' => 'usd',			
				]);
				
				return ['customer' => $customer , 'charge' => $charged];
			};

			return Charge::create([
				'amount' => 1000, //10 Dollars
				'currency' => 'usd',
				'description' => $data['email'],
				'card' => $data['token'] 			
			]);

		}
		catch (Card $e){
			dd($e->getMessage());
		}

		
	}

}