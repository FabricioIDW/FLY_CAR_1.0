@extends('layouts.plantilla')
@extends('layouts.partials.contenedorCotizaciones')
@section('title', 'Cotizacion')

@section('contend')
 
@section('contenedorCotizacion')
<div class="w-full h-17 pt-2 pb-8 col-span-3 lg:col-span-5"> 
    <h1 class="pt-2 text-center uppercase font-bold text-3xl">
        Cotizacion
    </h1> 
</div>
<div class="w-full h-17 pb-4 text-right col-auto shadow-lg">
    
</div>
<div class="lg:col-span-2">
    <h1 class="text-center text-bold text-sm shadow-lg">Accesorios</h1>
   </div>
   <div class="text-right col-auto shadow-lg">
    <h1 class="text-center text-bold text-sm">Precios</h1>
</div>
<div class="w-full h-17 pb-4 col-span-1 rounded-lg shadow-lg overflow-hidden">
<img class="w-full h-full rounded-lg" src="" alt="">
</div>
<div class="w-full h-17 pb-4 col-span-3 lg:col-span-4 shadow-lg">
</div>
<div class="w-full h-17 pb-4 col-span-1 shadow-lg overflow-hidden">
<img src="" alt="">
</div>
<div class="py-4 mx-4 col-span-4 font-bold text-2xl text-left">
<p>Importe total: </p>
</div>
<div class="capitalice col-span-3 lg:col-span-1 pt-4 pb-4 flex justify-end">
<button class="text-xs  lg:text-sm h-10 px-6 font-semibold rounded-full bg-blue-600 text-white" onclick="parent.location = '{{route('quotation')}}'">
    Generar Cotizacion
</button>
</div>
@endsection
@endsection