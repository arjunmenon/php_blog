<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Payment;
use App\PaymentStatus;
use App\Amount;
use App\Classes\PaymentGatewayClass;
use App\Traits\Helpers;

class PaymentController extends Controller
{
	use Helpers;

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

        $order = new Order;
        $amount = new Amount;
        $payment = new Payment;

        $amount->value = 5000;
        $amount->currency = 'INR';
        $amount->save();

        $payment->payment_status_id = PaymentStatus::idFor('created');
        $payment->amount()->associate($amount);
        $payment->user()->associate($user);
        $payment->save();

        $pg = new PaymentGatewayClass;
        $order_data = $pg->createOrder($user, $amount->value);

        $order->transaction_reference_number = $order_data["id"];
        $order->raw_response = $this->serialize($order_data);

        $order->amount()->associate($amount);
        $order->payment()->associate($payment);
        $order->save();

        $user->save();

        $user->refresh();

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

        $payment = $user->payments()->latest()->first();
        $payment->transaction_reference_number = $request->input('transaction_reference_number');
        $payment->transaction_signature = $request->input('transaction_signature');
        $payment->payment_status_id = PaymentStatus::idFor('captured');
        $payment->raw_response = $this->serialize($request->input('raw_response'));

        $payment->save();

        $user->paid = true;
        $user->save();

        // return response()->json([
        // 	'message' => 'success'
        // ]);

        return Redirect()->Route('dashboard')->with('success', "Payment was successfully processed");
        // return redirect('dashboard')->with('success', 'Profile updated!');
    }
}
