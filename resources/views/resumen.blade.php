<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Orden</title>
</head>
<body>
    <h2>Resumen de tu orden</h2>

    <ul>
        @foreach ($orden->platillos as $platillo)
            <li>
                {{ $platillo->nombre }} - Cantidad: {{ $platillo->pivot->cantidad }} - Subtotal: ${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total:</strong> ${{ $orden->total }}</p>

    <form method="POST" action="{{ route('orden.guardarNota', $orden->id) }}">
        @csrf
        <label>Notas para la cocina:</label><br>
        <textarea name="nota" rows="4" cols="50" placeholder="Ej: Sin cebolla, con sal extra..."></textarea><br><br>

        <button type="submit">Finalizar orden</button>
    </form>
</body>
</html>
