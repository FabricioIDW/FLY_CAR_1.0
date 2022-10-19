<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($amount)
    {
        return view('payments.index', compact('amount'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->accepted) {
            $payment = Payment::create([
                'amount' => $request->amount,
            ]);
            session(['payment_id' => $payment]);
        } else {
            session(['payment_id' => null]);
        }
        $pago = session('payment_id');
        return $pago;
        // return redirect()->route('productos.catalogo');
    }
}
