<?php

namespace App\Operations\Payment;

use App\Operations\BaseOperation;

use App\User;
use App\Order;
use App\Payment;
use App\PaymentStatus;
use App\Amount;
use App\Classes\PaymentGatewayClass;
use App\Traits\Helpers;
use Illuminate\Support\Facades\DB;

class Store extends BaseOperation
{
	use Helpers;

	public $order;
	public $amount;
	public $payment;
	public $pg;

	public function init()
	{
		// echo "This is from store class";
		// echo $this->user->id;

		$this->order = new Order;
		$this->amount = new Amount;
		$this->payment = new Payment;
		$this->pg = new PaymentGatewayClass;
	}

	public function validate()
	{

	}

	public function process()
	{
		DB::beginTransaction();

    	try
    	{
			// set and save the amount
			$this->amount->value = 500000;
			$this->amount->currency = 'INR';
			$this->amount->save();

			// set and save the payment
			$this->payment->payment_status_id = PaymentStatus::idFor('created');
			$this->payment->amount()->associate($this->amount);
			$this->payment->user()->associate($this->user);
			$this->payment->save();

			// call payment gateway to register an order
			$order_data = $this->pg->createOrder($this->user, $this->amount->value);

			// set and save the order
			$this->order->transaction_reference_number = $order_data["id"];
			$this->order->raw_response = $this->serialize($order_data);
			$this->order->amount()->associate($this->amount);
			$this->order->payment()->associate($this->payment);
			$this->order->save();

			DB::commit();
		}
		catch(\Exception $e){
	        DB::rollback();
	        // echo "Somethins went wonrg\n";
	        echo $e->getMessage();
	        // $this->addMessage('error', $e);
	    }
	}

	public function postProcess()
	{

	}
}