<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Órdenes Asignadas</title>
</head>
<body>
    <h1>Órdenes Asignadas</h1>

    @if($ordenes->isEmpty())
        <p>No tienes órdenes pendientes.</p>
    @else
        <ul>
            @foreach($ordenes as $orden)
                <li>
                    <strong>Orden #{{ $orden->id }}</strong> <br>
                    Total: ${{ $orden->total }} <br>
                    Fecha: {{ $orden->created_at->format('d/m/Y H:i') }} <br>
                    <u>Platillos:</u>
                    <ul>
                        @foreach($orden->platillos as $platillo)
                            <li>{{ $platillo->nombre }} (x{{ $platillo->pivot->cantidad }})</li>
                        @endforeach
                    </ul>
                    <hr>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>

