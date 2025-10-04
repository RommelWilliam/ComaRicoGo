@extends('layouts.cocinero')

@section('title', 'Órdenes Finalizadas')

@section('contenido')
@Vite(['resources/css/app.css'])
    <h1 class="text-2xl font-bold mb-4">Órdenes Finalizadas</h1>

    @if($ordenes->isEmpty())
        <p class="text-gray-600">No has finalizado órdenes aún.</p>
    @else
        <ul class="space-y-4">
            @foreach($ordenes as $orden)
                <li class="p-4 border rounded-lg shadow-sm bg-white">
                    <strong class="text-lg">Orden #{{ $orden->id }}</strong>  
                    <span class="text-gray-700">
                        Finalizada el {{ $orden->updated_at->format('d/m/Y H:i') }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
