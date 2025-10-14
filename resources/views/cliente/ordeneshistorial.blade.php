<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Órdenes</title>
</head>
<body>
    <h1>Historial de Órdenes</h1>

    @if($ordenes->isEmpty())
        <p>No tienes órdenes registradas aún.</p>
    @else
        @foreach($ordenes as $orden)
            <div style="border: 1px solid #ccc; margin-bottom: 15px; padding: 10px;">
                <h2>Orden #{{ $orden->id }}</h2>
                <p><strong>Fecha:</strong> {{ $orden->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Total:</strong> ${{ number_format($orden->total, 2) }}</p>

                <p><strong>Estado:</strong>
                    @if($orden->estado == 'pendiente')
                        🕒 Recibida
                    @elseif($orden->estado == 'en_proceso')
                        👨‍🍳 En preparación
                    @elseif($orden->estado == 'finalizada')
                        ✅ Lista para recoger
                    @else
                        ❓ Desconocido
                    @endif
                </p>

                <h3>Platillos:</h3>
                <ul>
                    @foreach($orden->platillos as $platillo)
                        <li>
                            {{ $platillo->nombre }} — Cantidad: {{ $platillo->pivot->cantidad }}
                            — Subtotal: ${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
</body>
</html>
