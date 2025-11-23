<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        //
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
