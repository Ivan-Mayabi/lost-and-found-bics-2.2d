<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::paginate(env('DEFAULT_PAGINATE_NUMBER',10));
        return view('admin.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $token = $request->token;
        $id = $request->id;
        return view('user.temporary-id-payment.payment',compact('token','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment();
        $payment->method = "MPesa";
        $payment->amount = 1000;
        $payment->verified =0;
        $payment->payment_id_token = Str::random(32);
        $token = $payment->payment_id_token;
        $payment->save();
        $id = $payment->id;
        return redirect()->route('payments.create',compact('token','id'))->with('success','You have successfully paid, please wait while your payment is verified');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Approve a payment
     */
    public function approve(Payment $payment)
    {
        $payment->verified = 1;
        $payment->save();
        return redirect()->route('payments.index')->with('success','Payment Verified Successfully');
    }

    /**
     * Unverify a payment
     */
    public function reject(Payment $payment)
    {
        $payment->verified = 0;
        $payment->save();
        return redirect()->route('payments.index')->with('warning','Payment Rejected Successfully');
    }
}
