<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden Finalizada</title>
    @vite(['resources/css/app.css'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <x-top_bar></x-top_bar>
    @if (isset($success))
        <div class="bg-green-200 w-full p-2 text-green-800 font-bold">{{$success}}</div>
    @endif
    <div class="bg-gray-100 p-4 h-screen">
        <div class="rounded-lg shadow-lg bg-white p-6 max-w-4xl mx-auto flex flex-col items-center">
            <h2 class="text-3xl font-bold text-center">¡Tu orden ha sido finalizada!</h2>

            <p class="text-xl text-center my-5">Gracias por tu pedido. Podés descargar el resumen en PDF aquí:</p>

            <a href="{{ route('orden.descargarPDF', $orden->id) }}" target="_blank">
                <button type="button" class="p-4 my-4 text-white rounded-lg bg-orange-500 hover:bg-orange-700 text-lg font-bold">Descargar orden (PDF)</button>
            </a>

            <form action="{{ route('orden.calificar') }}" method="POST">
                @csrf
                <input type="hidden" name="orden_id" value="{{ $orden->id }}">
                <x-star-rating name="rating" value="{{ old('rating', isset($rating)? $rating: 0) }}" />
                <button type="submit">Calificar</button>
            </form>
            <a href="/menu" class="my-5 underline text-lg hover:text-orange-500">Volver al menú</a>
        </div>

    </div>
</body>
</html>
