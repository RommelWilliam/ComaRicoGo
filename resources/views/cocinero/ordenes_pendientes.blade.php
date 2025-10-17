@extends('layouts.cocinero')

@section('title', 'Órdenes Pendientes')

@section('contenido')
@Vite(['resources/css/app.css'])
    <h1 class="text-2xl font-bold mb-4 text-center">Órdenes Pendientes</h1>

    @if($ordenes->isEmpty())
        <p class="text-gray-600 text-center">No hay órdenes pendientes.</p>
    @else
        <ul class="space-y-4 flex flex-wrap gap-6 justify-center">
            @foreach($ordenes as $orden)
                <li class="p-4 bg-white shadow-lg rounded-lg hover:scale-105 hover:border hover:border-orange-400 transition-transform">
                    <div class="flex justify-between items-center">
                        <div>
                            <strong class="text-lg">Orden #{{ $orden->id }}</strong>  
                            <span class="ml-2 text-gray-700 font-semibold">
                                ${{ $orden->total }}
                            </span>
                            <div class="mt-2">
                                <u>Platillos:</u>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach($orden->platillos as $platillo)
                                        <li>{{ $platillo->nombre }} (x{{ $platillo->pivot->cantidad }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cocinero.asignarOrden', $orden->id) }}">
                            @csrf
                            <button type="submit" 
                                class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
                                Asignarme esta orden
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
