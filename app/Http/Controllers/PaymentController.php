<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operations\Payment\Store;
use App\Operations\Payment\Update;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user = auth()->user();
        $result = Store::call($user, ['request' => $request]);

        return response()->json([
		    'transaction_reference_number' => $user->payments()->latest()->first()->order->transaction_reference_number,
		    'amount' => $user->payments()->latest()->first()->amount->value,
		    'currency' => $user->payments()->latest()->first()->amount->currency,
		    'note' => $user->payments()->latest()->first()->order->note,
		    'raw_response' => $user->payments()->latest()->first()->order->raw_response,
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	$user = auth()->user();
        $result = Update::call($user, ['request' => $request]);

        return Redirect()->Route('dashboard')->with('success', "Payment was successfully processed");
    }
}
