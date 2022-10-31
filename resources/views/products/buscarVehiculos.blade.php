@extends('layouts.plantilla')
@section('content')
    <div class="content">

        {{-- NAVBAR  --}}

        <div class="m-auto justify-between flex items-center text-gray-700">
            <a href="{{ route('admin.index') }}"><button
                    class="block py-3 px-4 mx-2 rounded focus:outline-none hover:bg-gray-200 group">
                    <div class="flecha">
                        <div></div>
                    </div> {{-- La clase flecha hace la flecha en css  --}}
                </button></a>
            <div class="titulos">FLY<br>CAR</div>
            <div>IMAGEN SESION</div>

            {{-- END NAVBAR  --}}

        </div>

        {{-- Scroll Vehiculos  --}}
        <div class="w-11/12 mx-auto place-items-center max-h-full">
            <div class="text-2xl font-semibold text-center">Vehiculos</div>
            <div class="text-center"><input type="search" id="searchV" placeholder="ID, marca, modelo..."
                    class="h-6 rounded-xl"></div> {{-- BUSCADOR --}}
            <div class="scroll-containerChico mx-auto">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-center">ID</th>
                            <th class="py-3 px-6 text-center">Marca</th>
                            <th class="py-3 px-6 text-center">Modelo</th>
                            <th class="py-3 px-6 text-center">N° de chasis</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="alldataV" class="text-gray-600 text-sm font-light bg-gray-200">
                        @foreach ($vehiculos as $vehiculo)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-3 text-center whitespace-nowrap">
                                    <div class="items-center">
                                        <div class="mr-2">
                                            <span class="font-medium">{{ $vehiculo->id }}</span>
                                        </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="items-center">
                                        <span>{{ $vehiculo->vehicleModel->brand->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="items-center">
                                        <span>{{ $vehiculo->vehicleModel->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="items-center">
                                        <span>{{ $vehiculo->chassis }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route('vehiculos.editar', $vehiculo) }}">{{-- EDITAR VEHICULO --}}
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                        </a>
                                        <div class="overflow-x-auto">
                                            <div class="overflow-x-auto">
                                                <x-button openBtn="Eliminar" value="{{ $vehiculo->id }}"></x-button>
                                            </div>
                                        </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody id="contenidoV" class="searchDataV text-gray-600 text-sm font-light bg-gray-200">
                    </tbody>
                </table>

                <script type="text/javascript">
                    $('#searchV').on('keyup', function() {
                        $value = $(this).val();

                        if ($value) {
                            $('#alldataV').hide();
                            $('.searchDataV').show();
                        } else {
                            $('#alldataV').show();
                            $('.searchDataV').hide();
                        }

                        $.ajax({

                            type: 'get',
                            url: '{{ URL::to('busquedaV') }}',
                            data: {
                                'searchV': $value
                            },

                            success: function(data) {
                                console.log(data);
                                $('#contenidoV').html(data);
                            }
                        });
                    })
                </script>
                <x-modal title="Eliminar Vehiculo" leftBtn="Eliminar" rightBtn="Cancelar" ref="vehiculos.baja"
                    value="" id="idModal">
                    <p>¿Seguro que quiere dar de baja a este vehículo?</p>
                </x-modal>
            </div>
        </div>
    </div>
    </div>
    <div class="text-center ">@include('layouts.partials.footer')</div>
    </div>
    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        openmodal.forEach(element => {
            const modal = document.getElementById('idRefDestroy');
            element.addEventListener('click', function(event) {
                event.preventDefault();
                toggleModal();
                console.log(element.value);
                modal.href = `vehicleDown/${element.value}`;
            });
        });

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };

        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }
    </script>
    {{-- Termina div content --}}
@endsection

{{-- --------------------------------------------- --}}
