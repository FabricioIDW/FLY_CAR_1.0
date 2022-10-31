@extends('layouts.plantilla')
@extends('layouts.partials.contenedorMiCotizacion')
@section('title', 'Mi Cotizacion')

@section('contend')
 
@section('contenedorMiCotizacion')
<div class="w-full h-17 pt-2 pb-8 col-span-3 lg:col-span-6"> 
    <div class="w-full h-8 pt-2 pl-8 col-span-1 lg:col-span-1">
        <a href="{{route('home')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
              </svg>
        </a> </div>
    <h1 class="pt-2 text-center uppercase font-bold text-3xl  hover:shadow-sky-600">
    Mi Cotizacion
    </h1> 
</div>

@foreach ($vehiculos as $vehiculo)

<div class="w-50% h-17 pb-4 text-right col-span-4 lg:col-span-3 sm:col-span-4">
   <div class="w-100% col-span-4 lg:col-span-3">
    <div class="col-span-3 sm:col-span-1 lg:col-span-1 ">
    <p class="float-left text-left mx-2 col-span-1">
        <span class="text-xl font-bold">Modelo: </span>{{$vehiculo->vehicleModel->name}} <br>
        <span class="text-xl font-bold">Marca: </span>{{$vehiculo->vehicleModel->brand->name}} <br>
        <span class="text-xl font-bold">Año: </span>{{$vehiculo->year}} <br>
        <span class="text-xl font-bold w-full flex-none mt-2 order-1 text-green-700">Precio: $ {{round($vehiculo->price,2)}}</span><span class="text-red-600 ml-4 text-sm font-semibold">{{$vehiculo->offer->discount}} %</span>
        
       </p>
    </div>
       <div class="mx-3 col-span-4 sm:col-span-1 lg:px-0 lg:col-span-1  rounded-lg shadow-lg overflow-hidden ">
        <img class="w-full rounded-lg  " src="{{$vehiculo->image}}" alt="">
        </div>
    </div>
<div class="col-span-4 lg:col-span-1">
    <h1 class="ml-3 text-left text-opacity-50  text-sm">Accesorios</h1>
  
  
   
   <p class=" text-left py-0">
    <?php
    if(!(empty($colecAccesorios[$vehiculo->id]))){
    ?>
    @foreach ($colecAccesorios[$vehiculo->id] as $accesorio)
          <li class="text-sm ml-3 my-1 font-bold text-left"> {{$accesorio->name}} <span class="text-sm my-1 font-semibold text-center text-green-700 text-left"> $ {{round($accesorio->getPrice($accesorio->getPrice($vehiculo->vehicleModel->accessories[0]->pivot->price)),2)}} </span></li>
@endforeach
<?php
}
?>
   </p>
   </div>
  


</div>
@endforeach

<div class="py-0 px-12 mx-4 col-span-3 lg:col-span-6 font-bold  text-left">
<p class="text-2xl pr-8 float-right">Importe total: <span >$ {{round($quotation->finalAmount, 2)}}</span> </p>
<p class="text-red-600 pr-8">Esta cotización vence el día {{ $quotation->dateTimeExpiration}}hs.</p>
<p class="text-xs">Fecha de creación de la cotización {{$quotation->dateTimeGenerated}} </p>
</div>
{{-- popup para reserva --}}
<div class="capitalice col-span-6 pt-4 pb-4 flex justify-center">
    @if ($quotation->reserve)
    <x-popup openBtn="Reservar" title="Reserva" leftBtn="Ok" rightBtn="Cancelar" ref="home"
        value="{{ $quotation->id }}">
        <p>Ya realizó la reserva de esta cotización.</p>
        <p>La reserva es válida hasta {{ $quotation->reserve->dateTimeExpiration }}</p>
    </x-popup>
@else
    @php
        $values = ['action' => 'reserve', 'amount' => $reserve->amount];
    @endphp
    <x-popup openBtn="Reservar" title="Reserva" leftBtn="Realizar pago" rightBtn="Cancelar" ref="payments.index"
        :value=$values>
        <p>Importe de la cotización: ${{ $quotation->finalAmount }}</p>
        <p>Importe de la seña a pagar: ${{ $reserve->amount }}</p>
        <p>(5% del importe de la cotización)</p>
    </x-popup>
@endif
{{--     
<button class="text-xs  lg:text-sm h-10 px-6 font-semibold rounded-full bg-blue-600 text-white" onclick="parent.location = '{{route('quotations.show', '1')}}'">
    Realizar Reserva
</button> --}}
</div>
<div class="col-span-6">@include('layouts.partials.footer')</div>
@endsection
@endsection