<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
	// public function created()
	// {
	// 	$this->name === 'created';
	// }

	// public function completed()
	// {
	// 	$this->name === 'captured';
	// }

	// public function authorized()
	// {
	// 	$this->name === 'authorized';
	// }

	public static function idFor($name)
	{
		return \DB::table("payment_statuses")
											->select("payment_statuses.*")
											->where('name', $name)
											->get()
											->first()
											->id;
	}
}
