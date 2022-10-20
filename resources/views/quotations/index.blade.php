@extends('layouts.plantilla')
@section('title', 'Cotizacion')
@section('content')
    @if ($quotation->reserve)
    <x-modal openBtn="Reservar" title="Reserva" leftBtn="Ok" rightBtn="Cancelar" ref="quotations.show" value="{{$quotation->id}}">
            <p>Ya realizó la reserva de esta cotización.</p>
            <p>La reserva es válida hasta {{ $quotation->reserve->dateTimeExpiration }}</p>
        </x-modal>
    @else
        @php
            $values = ['action' => 'reserve', 'amount' => $reserve->amount];
        @endphp
        <x-modal openBtn="Reservar" title="Reserva" leftBtn="Realizar pago" rightBtn="Cancelar" ref="payments.index"
            :value=$values>
            <p>Importe de la cotización: ${{ $quotation->finalAmount }}</p>
            <p>Importe de la seña a pagar: ${{ $reserve->amount }}</p>
            <p>(5% del importe de la cotización)</p>
        </x-modal>
    @endif
@endsection
