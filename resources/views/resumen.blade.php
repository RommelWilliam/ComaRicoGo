<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Orden</title>
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <x-top_bar/>
    <div class="bg-gray-100 p-4 h-screen">
        <div class="rounded-lg shadow-lg bg-white p-6 max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-center">Resumen de tu orden</h2>
            <ul class="mt-4">
                @foreach ($orden->platillos as $platillo)
                    <li class="p-4 border border-gray-300 mb-4 flex items-center justify-between rounded-lg">
                        <div class="text-2xl font-bold">x{{ $platillo->pivot->cantidad }}</div>
                        <div class="text-xl">{{ $platillo->nombre }}</div>
                        <div class="text-xl font-bold">${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}</div>
                    </li>
                @endforeach
            </ul>

            <div class="text-end text-3xl font-bold">Total: <span class="text-orange-500">${{ $orden->total }}</span> </div>

            <form method="POST" action="{{ route('orden.guardarNota', $orden->id) }}" class="w-full mt-6 flex flex-col items-center">
                @csrf
                <label class="text-lg w-full text-left">Notas para la cocina:</label><br>
                <textarea name="nota" rows="4" cols="50" placeholder="Ej: Sin cebolla, con sal extra..."
                class="w-full outline-none border border-gray-600 rounded-lg focus:border-orange-500 "></textarea>

                <br><br>

                <label class="text-lg w-full text-left">Nombre de contacto:</label><br>
                <input type="text" name="contacto_nombre" placeholder="Ej: Juan Pérez"
                class="w-full outline-none border border-gray-600 rounded-lg focus:border-orange-500">

                <br>

                <label class="text-lg w-full text-left">Teléfono:</label><br>
                <input type="text" name="contacto_telefono" placeholder="Ej: 7777-8888"
                class="w-full outline-none border border-gray-600 rounded-lg focus:border-orange-500">

                <button type="submit" class="p-4 my-4 text-white rounded-lg bg-orange-500 hover:bg-orange-700 text-lg font-bold">Finalizar orden</button>
            </form>
        </div>
    </div>
</body>
</html>
