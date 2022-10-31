
@extends('layouts.plantilla')
@extends('layouts.partials.contenedorCotizaciones')
@section('title', 'Cotizacion')

@section('contend')
 
@section('contenedorCotizacion')
<div class="w-full h-full pt-2 pb-8 col-span-4 lg:col-span-5"> 
    <div class="w-full h-8 pt-2 pl-8 col-span-1 lg:col-span-1">
        <a href="{{route('quotations.simularCotizacion', end($vehiculos))}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
          </svg>
        </a> </div>
    <h1 class="pb-8 w-full text-center mt-2 order-1 text-2xl uppercase lg:capitalize lg:text-3xl font-bold text-blue-700">
        Cotizacion
    </h1> 
</div>
@php $precioFinal = 0; @endphp
@foreach ($vehiculos as $vehiculo)

<div class="w-full h-17 pb-4 text-right col-span-4 lg:col-span-2 sm:col-span-1">
    <p class="text-left mx-2">
        <span class="text-xl font-bold">Modelo: </span>{{$vehiculo->vehicleModel->name}} <br>
        <span class="text-xl font-bold">Marca: </span>{{$vehiculo->vehicleModel->brand->name}} <br>
        <span class="text-xl font-bold">Año: </span>{{$vehiculo->year}} <br>
        <span class="text-xl font-bold w-full flex-none mt-2 order-1 text-green-700">Precio: $ {{round($vehiculo->price,2)}}</span>
        @php $precioFinal += $vehiculo->getPrice(); @endphp
        @if ((is_null($vehiculo->offer)))
        <span class="text-green-700 ml-4 font-semibold"> 0 %</span>
          @else
          <span class="text-red-600 ml-4 font-semibold">{{$vehiculo->offer->discount}} %</span>
      @endif
        
       </p>
</div>
<div class="col-span-4 lg:col-span-1">
    <h1 class="text-center text-bold text-sm">Accesorios</h1>
  
  
   
   <p class="text-left mx-1 py-0">
    <?php
    $precioFinalAccesorio = 0;
    if(!(empty($colecAccesorios[$vehiculo->id]))){
    ?>
    @foreach ($colecAccesorios[$vehiculo->id] as $accesorio)
          <li class="text-sm my-1 font-bold text-left"> {{$accesorio->name}} </li>
@endforeach
<?php
}
?>
   </p>
   </div>
   <div class="col-span-4 lg:col-span-1 text-right">
    <h1 class="text-center text-bold text-sm">Precios</h1>
    <p class="text-left mx-1 py-0">
        <?php
    if(!(empty($colecAccesorios[$vehiculo->id]))){
    ?>
    @foreach ($colecAccesorios[$vehiculo->id] as $accesorio)
    <li class="text-sm my-1 font-semibold text-center text-green-700 text-left">$ {{round($accesorio->getPrice($accesorio->getPrice($vehiculo->vehicleModel->accessories[0]->pivot->price)),2)}} @php $precioFinal += $accesorio->getPrice($accesorio->getPrice($vehiculo->vehicleModel->accessories[0]->pivot->price)); @endphp</li>
    @endforeach
    <?php
    
    }
    ?>  
    </p>
</div>

<div class="w-full mx-3 col-span-3 sm:col-span-4 sm:px-12 sm:col-span-4 lg:px-0 lg:col-span-1  rounded-lg shadow-lg overflow-hidden">
<img class="w-full rounded-lg " src="{{$vehiculo->image}}" alt="">
</div>

@endforeach
<div class="pt-4 mx-4 col-span-4 font-extrabold text-2xl text-left text-green-700">
<p class="mx-10 font-bold"> <span class="font-bold text-black text-left">Importe total: </span> <span class="float-right">$ {{round($precioFinal,2)}} </span></p>
</div>
<div class="capitalice col-span-3 lg:col-span-1 pt-4 pb-4 pr-0 flex justify-end">
    @if (!session()->exists('user')) 
    {{-- @php  
    $usuario = User::find('1');//session('user');
    $customer = Customer::where('user_id',$usuario->id)->first();///busco usuario de roll cliente
    @endphp
        @if ($customer->hasValidQuotation()) --}}
   <x-popup  openBtn="Generar Cotizacion" title="Usted tiene una cotizacion vigente" leftBtn="Continuar Operacion" rightBtn="Cancelar Operacion" ref="quotations.miCotizacion"
    value="">
    <p>
        ¿Desea continuar con la operacion?
     </p> 
    </x-popup>
     {{-- @else   
     <x-modal  openBtn="Generar Cotizacion" title="Generar una Cotizacion" leftBtn="Cancelar" rightBtn="Continuar" ref="quotations.miCotizacion"
     value="">
     <p>
    ¿Desea continuar con la operacion?
      </p> 
     </x-modal>
     @endif --}}
    @else
        <button class="text-xs content-center lg:text-sm h-10 px-6 font-semibold hidden:bg-blue-400 rounded-full bg-blue-700 text-white hover:bg-opacity-40 hover:text-blue-700" onclick="parent.location = '{{route('quotations.miCotizacion')}}'" disabled>
        Iniciar Session
        </button>
    @endif



</div>
<div class="col-span-6">@include('layouts.partials.footer')</div>
@endsection

@endsection