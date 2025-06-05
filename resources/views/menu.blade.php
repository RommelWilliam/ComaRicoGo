<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Platillos</title>
</head>
<body>
    <h1>Menú</h1>

    <form action="{{ route('orden.enviar') }}" method="POST">
        @csrf

        @foreach ($platillos as $platillo)
            <div style="margin-bottom: 20px;">
                <h3>{{ $platillo->nombre }}</h3>
                <p>{{ $platillo->descripcion }}</p>
                <p><strong>Precio:</strong> ${{ $platillo->precio }}</p>
                <label>Cantidad:</label>
                <input type="number" name="platillos[{{ $platillo->id }}]" min="0" max="{{ $platillo->cantidad }}" value="0">
            </div>
        @endforeach

        <button type="submit">Enviar Orden</button>
    </form>
</body>
</html>
