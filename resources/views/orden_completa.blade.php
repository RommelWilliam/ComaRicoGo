<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden Finalizada</title>
</head>
<body>
    <h2>¡Tu orden ha sido finalizada!</h2>

    <p>Gracias por tu pedido. Podés descargar el resumen en PDF aquí:</p>

    <a href="{{ route('orden.descargarPDF', $orden->id) }}" target="_blank">
        <button type="button">Descargar orden (PDF)</button>
    </a>

    <br><br>
    <a href="/menu">Volver al menú</a>
</body>
</html>
