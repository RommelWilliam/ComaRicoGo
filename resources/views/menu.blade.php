<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menú de Platillos</title>
    @vite('resources/css/app.css')
</head>
<body class="">
    <x-top_bar/>
    <div class="bg-gray-200 p-4 h-full">
        <div class="rounded-lg shadow-lg bg-white p-6 max-w-4xl mx-auto">
            <h1 class="text-2xl font-bold text-center">Menú</h1>
            <form action="{{ route('orden.enviar') }}" method="POST" class="flex flex-col items-center">
                @csrf

                @foreach ($platillos as $platillo)
                    <div class="w-full border border-gray-400 rounded-lg my-4 flex p-4">
                        <img src="{{ asset('platillos/' . $platillo->img) }}" alt="Imágen de {{ $platillo->nombre }}" class="w-32 h-32 object-cover rounded-lg mr-4">
                        <div class="flex-1">
                            <h3 class="font-bold">{{ $platillo->nombre }}</h3>
                            <p>{{ $platillo->descripcion }}</p>
                        </div>
                        
                        <div class="">
                            <div class="text-2xl font-bold text-right">${{ $platillo->precio }}</div>
                            <label>Cantidad:</label>
                            <input type="number" name="platillos[{{ $platillo->id }}]" min="0" max="{{ $platillo->cantidad }}" value="0"
                            class="w-20 border border-gray-500 rounded-lg px-2 py-1 text-center focus:border-orange-500 outline-none">
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="p-4 text-white rounded-lg bg-orange-500 hover:bg-orange-700">Enviar Orden</button>
            </form>
        </div>
    </div>
</body>
</html>
