<?php

namespace App\Classes;

use Razorpay\Api\Api;
use App\User;
use App\Payment;
use App\Order;
use App\Traits\Helpers;

class PaymentGatewayClass
{
	use Helpers;

	private $api;

	public function __construct()
	{
		$api_key = env("RZP_KEY",  "null");
		$api_secret = env("RZP_SECRET", "null");
		$this->api = new Api($api_key, $api_secret);
	}

	public function createOrder(User $user, $amount)
	{
		$order = $this->api->order->create(array(
		  'receipt' => '123',
		  'amount' => $amount,
		  'payment_capture' => 1,
		  'currency' => 'INR'
		  )
		);
		return $this->objectToArray($order);
	}
}