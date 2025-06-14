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
    <div class="bg-gray-200 p-4 h-screen">
        <div class="flex items-start justify-center space-x-5 max-md:flex-col max-md:items-stretch max-md:space-y-5 max-md:space-x-0">
            <div class="flex-grow flex-shrink-0 rounded-lg shadow-lg bg-white p-6 max-w-5xl">
                <h2 class="text-2xl font-bold text-center max-md:text-xl">Resumen de tu orden</h2>
                <ul class="mt-4">
                    @foreach ($orden->platillos as $platillo)
                        <li class="p-4 border border-gray-400 mb-4 flex items-center justify-between rounded-lg">
                            <div class="text-2xl font-bold max-md:text-lg">x{{ $platillo->pivot->cantidad }}</div>
                            <div class="text-xl max-md:text-lg">{{ $platillo->nombre }}</div>
                            <div class="text-xl max-md:text-lg font-bold">${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}</div>
                        </li>
                    @endforeach
                </ul>

                <div class="text-end text-3xl font-bold max-md:text-2xl max-md:text-center">Total: <span class="text-orange-500">${{ number_format($orden->total,2) }}</span> </div>
            </div>

            <form method="POST" action="{{ route('orden.guardarNota', $orden->id) }}" class="flex-shrink flex flex-col items-center bg-white p-6 rounded-lg shadow-lg max-w-xl max-md:max-w-full w-full">
                @csrf
                <label class="text-2xl font-bold text-center mb-4 max-md:text-xl">Detalles de tu orden</label>
                <label class="text-lg w-full text-left">Notas para la cocina:</label>
                <textarea name="nota" rows="4" cols="50" placeholder="Ej: Sin cebolla, con sal extra..."
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md focus:border-orange-500 "></textarea>

                <label class="text-lg w-full text-left">Nombre de contacto:</label>
                <input type="text" name="contacto_nombre" placeholder="Ej: Juan Pérez"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md focus:border-orange-500">

                <label class="text-lg w-full text-left">Teléfono:</label>
                <input type="tel" maxlength="8" name="contacto_telefono" placeholder="Ej: 7777-8888"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md focus:border-orange-500">

                <button type="submit" class="p-4 my-4 text-white rounded-lg bg-orange-500 hover:bg-orange-700 text-lg font-bold">Finalizar orden</button>
            </form>
        </div>
    </div>
</body>
</html>
