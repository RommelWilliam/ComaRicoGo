@extends('layouts.cocinero')

@section('titulo', 'Reportes de Cocina')

@section('contenido')
@Vite(['resources/css/app.css'])
    <h1 class="text-2xl font-bold mb-4 text-center">Reportes de Cocina</h1>
<div class="flex justify-center flex-wrap bg-white p-6 my-5 rounded-lg shadow-xl max-w-max mx-auto">
    <form method="POST" action="{{ route('cocinero.registrarReporte') }}" class="flex flex-col items-center gap-4">
        @csrf
        <h2 class="text-xl text-center font-bold mx-5">Nuevo Reporte</h2>
        <textarea name="descripcion" placeholder="Describe la falla o problema..." rows="10" cols="60" required
        class="bg-gray-100 rounded-lg py-2 px-4 outline-orange-400 border border-orange-200"></textarea>
    
        <button type="submit" class="max-w-max px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Enviar Reporte</button>
    </form>

    <div class="max-w-xl before:content-[''] before:absolute before:inset-y-0 before:left-0 before:w-0.5 before:bg-gray-300 relative mx-8">
        <h2 class="text-xl text-center font-bold mx-5">Historial de Reportes</h2>

    @if($reportes->isEmpty())
        <p class="mx-5">No has registrado reportes aún.</p>
    @else
        <ul class="mx-5 my-2 space-y-2">
            @foreach($reportes as $reporte)
                <li>
                    <strong>{{ $reporte->fecha_reporte->format('d/m/Y H:i') }}</strong> — 
                    {{ $reporte->descripcion }}
                </li>
            @endforeach
        </ul>
    @endif
    </div>
    
</div>
    
@endsection
