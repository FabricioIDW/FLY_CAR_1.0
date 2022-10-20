@extends('layouts.plantilla')
@extends('layouts.partials.contenedorCotizaciones')
@section('title', 'Mi Cotizacion')

@section('contend')
 
@section('contenedorCotizacion')
<div class="w-full h-17 pt-2 pb-8 col-span-3 lg:col-span-5"> 
    <h1 class="pt-2 text-center uppercase font-bold text-3xl">
    Mi Cotizacion
    </h1> 
</div>
<div class="col-span-2 lg:col-span-3">
</div>
<div class="py-4 mx-4 col-span-3 lg:col-span-5 font-bold text-2xl text-left">
<p>Importe total: </p>
<p>cotizacion valida</p>
</div>
<div class="capitalice col-span-5 pt-4 pb-4 flex justify-center">
<button class="text-xs  lg:text-sm h-10 px-6 font-semibold rounded-full bg-blue-600 text-white" onclick="parent.location = '{{route('home')}}'">
    Realizar Reserva
</button>
</div>
@endsection
@endsection