<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

	protected $casts = [
        'raw_response' => 'array',
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function amount()
    {
        return $this->belongsTo('App\Amount');
    }
}
