@extends('layouts.plantilla')
@section('title', $vehiculo->vehicleModel->brand->name)

@section('content')
<div class="justify-center">
  <div class="w-full h-8 pt-2 pl-8 col-span-1 lg:col-span-1">
    <a href="{{route('home')}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
          </svg>
    </a> </div>
  <div class="py-8 ml-6 mr-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5 shadow-lg">

        <div class="bg-blue-200 shadow-lg col-span-2 md:col-span-3 lg:col-span-3 row-span-2 flex-none relative rounded-lg">
          <img class="shadow-lg absolute inset-0 lg:w-full lg:h-full object-cover rounded-lg" src="{{$vehiculo->image}}"  alt="chevlolet cruze">
        </div>
        <div class="bg-black-400 col-span-1 lg:col-span-2 row-span-2 rounded-b-lg">
          <div class="pb-8 w-full flex-none mt-2 order-1 text-3xl font-bold text-blue-700">
           {{$vehiculo->vehicleModel->brand->name.' '.$vehiculo->vehicleModel->name}}
          </div>
          <p class="">
           <span class="text-xl font-bold">Año: </span>{{$vehiculo->year}} <br>
           <span class="text-xl font-bold">Marca: </span>{{$vehiculo->vehicleModel->brand->name}} <br>
           <span class="text-xl font-bold">Modelo: </span>{{$vehiculo->vehicleModel->name}} <br>
           <span class="text-xl font-bold">Descripcion: </span>{{$vehiculo->description}} <br>
          </p>
          <div class="w-full flex-none mt-2 order-1 text-2xl font-bold text-green-700">
            Precio $ {{round($vehiculo->getPrice(),2)}}
          </div>
          <div class="w-full flex-none mt-2 order-1 text-sm font-bold text-red-600">
            @if ((is_null($vehiculo->offer)))
              <span class="text-green-700">Actualmente no posee ninguna oferta</span>
                @else
                Actualmente posee una oferta del  {{$vehiculo->offer->discount}} %
            @endif
            
          </div>
        </div>
          <form class="col-span-5 row-span-3  flex-auto p-6" action="{{route('quotations.cotizar')}}" method="POST"> 
            @csrf
            <div class="col-span-3 row-span-3 pt-8 flex-auto p-6 rounded-b-lg hover:text-black">
            <div class="flex flex-wrap">
              <h1 class="flex-auto font-medium text-slate-900">
                Accesorios
              </h1>
              <div class="text-sm font-medium text-slate-400">
              Disponibles
              </div>
            </div>
            <div class="flex items-baseline mt-2 mb-2  border-b border-slate-200 shadow-lg">
              <div class="space-x-2 flex text-sm font-bold">
                @foreach ($vehiculo->vehicleModel->accessories as $unAccesorio)
                <div class="text-blue-700 ">
                <label id='{{$unAccesorio->id}}' class="mx-2 ">
                    {{$unAccesorio->name}}
                     </div><input class="" name="accesorios[]" type="checkbox" value="{{$unAccesorio->id}}" /> <span class=" text-gray-500 ml-4 font-semibold">$ {{round($unAccesorio->getPrice($unAccesorio->getPrice($vehiculo->vehicleModel->accessories[0]->pivot->price)),2)}}</span>
                </label>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-span-5 row-span-3 flex justify-end mb-5 text-sm font-medium rounded-bl-lg ">
            <div class="flex justify-end ">
              <?php
              
              if (session()->exists('vehiculo2')) {
              ?>
              <input class="mr-8 h-10 px-6 font-semibold rounded-full bg-red-600 text-white" type="submit" name="btnAgregar" value="Agregar otro Vehiculo" disabled>
              <?php  
              } else {
                ?>
              <input class="mr-8 h-10 px-6 font-semibold rounded-full bg-blue-600 text-white hover:bg-opacity-40" type="submit" name="btnAgregar" value="Agregar otro Vehiculo" >
              @php   
              }
              @endphp
              <input class="p-auto mr-4 h-10 px-6 font-semibold rounded-full bg-blue-600 text-white hover:bg-opacity-40" type="submit" name="btnSimular" value="Simular Cotizacion">
            </form>
            </div>
          </div>
  </div>
  </div>
  
  <script>
  
  </script>
  @include('layouts.partials.footer')
@endsection


