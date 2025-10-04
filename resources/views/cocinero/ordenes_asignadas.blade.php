@extends('layouts.cocinero')

@section('title', 'Órdenes Asignadas')

@section('contenido')
@Vite(['resources/css/app.css'])
    <h1 class="text-2xl font-bold mb-4 text-center">Órdenes en Proceso</h1>

    @if($ordenes->isEmpty())
        <p class="text-gray-600 text-center">No tienes órdenes en proceso.</p>
    @else
        <ul class="space-y-4 flex flex-wrap gap-6 justify-center">
            @foreach($ordenes as $orden)
                <li class="p-4 border rounded-lg shadow-sm bg-white">
                    <strong class="text-lg">Orden #{{ $orden->id }}</strong> 
                    <span class="font-bold text-orange-600">${{ $orden->total }}</span>
                    
                    <div class="mt-2">
                        <u class="font-semibold">Platillos:</u>
                        <ul class="list-disc list-inside">
                            @foreach($orden->platillos as $platillo)
                                <li>{{ $platillo->nombre }} (x{{ $platillo->pivot->cantidad }})</li>
                            @endforeach
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('cocinero.finalizarOrden', $orden->id) }}" class="mt-3">
                        @csrf
                        <button type="submit" 
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Finalizar Orden
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
