
@extends('layouts.plantilla')
@extends('layouts.partials.contenedorCotizaciones')
@section('title', 'Cotizacion')

@section('contend')
 
@section('contenedorCotizacion')
<div class="w-full h-full pt-2 pb-8 col-span-4 lg:col-span-5"> 
    <h1 class="pb-8 w-full text-center mt-2 order-1 text-2xl uppercase lg:capitalize lg:text-3xl font-bold text-blue-700">
        Cotizacion
    </h1> 
</div>

@foreach ($vehiculos as $vehiculo)

<div class="w-full h-17 pb-4 text-right col-span-4 lg:col-span-2 sm:col-span-1">
    <p class="text-left mx-2">
        <span class="text-xl font-bold">Modelo: </span>{{$vehiculo->vehicleModel->name}} <br>
        <span class="text-xl font-bold">Marca: </span>{{$vehiculo->vehicleModel->brand->name}} <br>
        <span class="text-xl font-bold">Año: </span>{{$vehiculo->year}} <br>
        <span class="text-xl font-bold w-full flex-none mt-2 order-1 text-green-700">Precio: $ {{round($vehiculo->price,2)}}</span><span class="text-red-600 ml-4 font-semibold">{{$vehiculo->offer->discount}} %</span>
       </p>
</div>
<div class="col-span-4 lg:col-span-1">
    <h1 class="text-center text-bold text-sm">Accesorios</h1>
  
  
   
   <p class="text-left mx-1 py-0">
    <?php
    if(!(empty($colecAccesorios[$vehiculo->id]))){
    ?>
    @foreach ($colecAccesorios[$vehiculo->id] as $accesorio)
          <li class="text-sm my-1 font-bold text-center"> {{$accesorio->name}} </li>
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
    <li class="text-sm my-1 font-bold text-center text-green-700">{{round($accesorio->getPrice($accesorio->price),2)}} </li>
    @endforeach
    <?php
    }
    ?>  
    </p>
</div>

<div class="w-full mx-3 col-span-3 sm:col-span-4 sm:px-12 sm:col-span-4 lg:px-0 lg:col-span-1 rounded-lg shadow-lg overflow-hidden">
<img class="w-full  rounded-lg " src="{{$vehiculo->image}}" alt="">
</div>

@endforeach
<div class="pt-4 mx-4 col-span-4 font-bold text-2xl text-left text-green-700">
<p class="mx-10 font-bold ">Importe total: ${{round($vehiculos[0]->getPriceEnd($vehiculos),2)}} </p>
</div>
<div class="capitalice col-span-3 lg:col-span-1 pt-4 pb-4 pr-0 flex justify-end">
<button class="text-xs content-center lg:text-sm h-10 px-6 font-semibold hidden:bg-blue-400 rounded-full bg-blue-700 text-white" onclick="parent.location = '{{route('quotations.generarCotizacion')}}'">
    Generar Cotizacion
</button>
</div>
@endsection
@endsection