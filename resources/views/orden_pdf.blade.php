<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden #{{ $orden->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Resumen de Orden #{{ $orden->id }}</h2>

    <p><strong>Cliente ID:</strong> {{ $orden->cliente_id }}</p>
    <p><strong>Fecha:</strong> {{ $orden->created_at->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Platillo</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orden->platillos as $platillo)
                <tr>
                    <td>{{ $platillo->nombre }}</td>
                    <td>{{ $platillo->pivot->cantidad }}</td>
                    <td>${{ number_format($platillo->precio, 2) }}</td>
                    <td>${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> ${{ number_format($orden->total, 2) }}</p>

    @if($orden->nota)
        <p><strong>Nota del cliente:</strong> {{ $orden->nota }}</p>
    @endif
    <a href="{{ route('orden.descargarPDF', $orden->id) }}" target="_blank">
    <button type="button">Descargar orden (PDF)</button>
</a>
</body>
</html>
