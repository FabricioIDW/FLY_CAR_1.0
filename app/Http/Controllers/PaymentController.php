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
    public function index($action, $amount)
    {
        session(['action' => $action]);
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
        // ¿Validar si la cotizacion posee una reserva se debe redireccionar?
        if ($request->accepted) {
            $payment = Payment::create([
                'amount' => $request->amount,
            ]);
            session(['payment' => $payment]);
        } else {
            session(['payment' => null]);
        }
        $pago = session('payment');
        if (session('action') == 'reserve') {
            return redirect()->route('reserves.create');
        }
        // return redirect()->route('productos.catalogo');
        // return $pago;
    }
}
