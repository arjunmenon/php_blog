<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $casts = [
        'raw_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\PaymentStatus', 'payment_status_id');
    }

    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function amount()
    {
        return $this->belongsTo('App\Amount');
    }

    public function paid()
    {
        return ($this->status()->name === 'captured');
    }
}


