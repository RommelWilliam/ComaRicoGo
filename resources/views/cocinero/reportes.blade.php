@extends('layouts.cocinero')

@section('titulo', 'Reportes de Cocina')

@section('contenido')
    <h1>Reportes de Cocina</h1>

    <form method="POST" action="{{ route('cocinero.registrarReporte') }}">
        @csrf
        <textarea name="descripcion" rows="4" placeholder="Describe la falla o problema..." required></textarea>
        <br>
        <button type="submit">Enviar Reporte</button>
    </form>

    <hr>

    <h2>Historial de Reportes</h2>

    @if($reportes->isEmpty())
        <p>No has registrado reportes aún.</p>
    @else
        <ul>
            @foreach($reportes as $reporte)
                <li>
                    <strong>{{ $reporte->fecha_reporte->format('d/m/Y H:i') }}</strong> — 
                    {{ $reporte->descripcion }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
