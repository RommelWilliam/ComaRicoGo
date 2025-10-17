@extends('layouts.cocinero')

@section('title', 'Órdenes Finalizadas')

@section('contenido')
@Vite(['resources/css/app.css'])
<h1 class="text-2xl font-bold mb-4 text-center">Órdenes Finalizadas</h1>

@if($ordenes->isEmpty())
    <p class="text-gray-600">No has finalizado órdenes aún.</p>
@else
<div class="flex justify-center flex-wrap">
    @foreach($ordenes as $orden)
    <div class= "bg-white my-7 mx-5 p-3 shadow-lg rounded-lg border border-orange-400
    hover:scale-105 transition-transform">
        <h2 class="text-lg w-full font-bold">Orden #{{ $orden->id }}</h2>
        <div class="flex">
            <div class="flex justify-between items-center">
                <div class="mt-2">
                    <u>Platillos:</u>
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach($orden->platillos as $platillo)
                            <li>{{ $platillo->nombre }} (x{{ $platillo->pivot->cantidad }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="p-4 rounded-lg before:content-[''] before:absolute before:inset-y-0 before:left-0 before:w-0.5 before:bg-gray-300 relative ml-5"> 
                <div class="text-gray-70o ml-5">
                    Finalizada el <strong>{{ $orden->fecha_finalizado}} </strong>
                </div>
                <div class="text-gray-70o ml-5">
                    Preparada en
                    <strong>
                            @if ($orden->fecha_finalizado)
                                @php
                                    $fechaFinalizado = $orden->fecha_finalizado instanceof \Carbon\Carbon
                                        ? $orden->fecha_finalizado
                                        : \Carbon\Carbon::parse($orden->fecha_finalizado);

                                    $updatedAt = $orden->updated_at instanceof \Carbon\Carbon
                                        ? $orden->updated_at
                                        : (is_numeric($orden->updated_at)
                                            ? \Carbon\Carbon::createFromTimestamp($orden->updated_at)
                                            : \Carbon\Carbon::parse($orden->updated_at));

                                    $diffMinutes = $fechaFinalizado->diffInMinutes($updatedAt);
                                @endphp
                                {{ $diffMinutes }} minutos
                            @else
                                N/A
                            @endif
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach  
</div>
@endif
@endsection
