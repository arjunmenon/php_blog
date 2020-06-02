<?php

namespace App\Operations\Payment;

use App\Operations\BaseOperation;

use App\User;
use App\Payment;
use App\PaymentStatus;
use App\Traits\Helpers;

class Update extends BaseOperation
{
	use Helpers;

	public $payment;

	public function init()
	{
		$this->payment = $this->user->payments()->latest()->first();
	}

	public function validate()
	{

	}

	public function process()
	{
        $this->payment->transaction_reference_number = $this->params["request"]->input('transaction_reference_number');
        $this->payment->transaction_signature = $this->params["request"]->input('transaction_signature');
        $this->payment->payment_status_id = PaymentStatus::idFor('captured');
        $this->payment->raw_response = $this->serialize($this->params["request"]->input('raw_response'));

        $this->payment->save();

        $this->user->paid = true;
        $this->user->save();
    }
}