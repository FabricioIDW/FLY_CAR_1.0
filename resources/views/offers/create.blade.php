@extends('layouts.plantilla')
@section('title', 'Crear oferta')
@section('content')
    <h1>Crear oferta</h1>
    <section>
        <form action="{{ route('offers.store') }}" method="POST">
            @csrf
            <label>
                <strong>Descuento:</strong>
                <input type="number" name="discount" step="0.1" min="0.1" max="99.9" value="{{ old('discount') }}">
            </label>
            @error('discount')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label>
                <strong>Fecha de inicio:</strong>
                <input type="date" name="startDate" value="{{ old('startDate') }}">
            </label>
            @error('startDate')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label>
                <strong>Fecha de fin:</strong>
                <input type="date" name="endDate" value="{{ old('endDate') }}">
            </label>
            @error('endDate')
                <br>
                <small>*{{ $message }}</small>
                <br>
            @enderror
            <br>
            <label>
                Seleccione los productos que tendrán esta oferta
            </label>
            <br>
            @if (count($vehicles) > 0)
                <label>
                    <strong>Vehículos:</strong>
                    <br>
                    <select name="vehicles[]" id="idVehicles" multiple size="5">
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicleModel->brand->name }} -
                                {{ $vehicle->vehicleModel->name }} - Chasis: {{ $vehicle->chassis }}</option>
                        @endforeach
                    </select>
                </label>
                <br>
            @else
                <p>No hay vehículos que no posean una oferta</p>
            @endif
            {{-- @foreach ($vehicles as $vehicle)
                <input type="checkbox" name="vehicle{{ $vehicle->id }}" value="{{ $vehicle->id }}"
                    id="vehicle{{ $vehicle->id }}">
                <label for="vehicle{{ $vehicle->id }}">{{ $vehicle->vehicleModel->brand->name }} -
                    {{ $vehicle->vehicleModel->name }} - Chasis: {{ $vehicle->chassis }} </label>
                <br>
            @endforeach --}}
            @if (count($accessories) > 0)
                <label>
                    <strong>Accesorios:</strong>
                    <br>
                    <select name="accessories[]" id="idAccessories" multiple size="5">
                        @foreach ($accessories as $accessory)
                            <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                        @endforeach
                    </select>
                </label>
                <br>
            @else
                <p>No hay accesorios que no posean una oferta</p>
            @endif
            <button type="submit">Crear oferta</button>
        </form>
    </section>
@endsection
