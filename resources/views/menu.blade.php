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
    <div class="bg-gray-200 p-4 h-full flex">
        <div class="border border-gray-400 bg-white rounded-lg mr-5 p-4 w-fit max-h-fit">
            <form action="{{ route('menu.filtrar') }}" method="GET"" class="">
                <h3 class="font-bold uppercase mb-2 text-center">Categorías</h3>
                @foreach ($categorias as $categoria)
                <input type="checkbox" name="categoria[]" value="{{ $categoria }}"
                
                @if(isset($categoriaSelecc) && in_array($categoria, $categoriaSelecc)) 
                    checked="true" 
                @endif
                
                class="mr-2 checked:bg-orange-500"/>
                <label for="categoria1" class="mr-4 uppercase">{{ $categoria }}</label><br/>    
                @endforeach
                <h3 class="font-bold uppercase my-2 text-center">Rango de Precios</h3>
                <div class="flex items-center gap-3">
                    <label for="rangoPrecio" class="text-sm">${{ $minPrecio }}</label>
                    <input type="hidden" name="minPrecio" value="{{ $minPrecio }}">
                    <input id="rangoPrecio" type="range" name="rangoPrecio" value="{{ request('rangoPrecio', $maxPrecio) }}" min="{{ $minPrecio }}" max="{{ $maxPrecio }}" step="0.01" class="accent-orange-500 flex-1" aria-describedby="rangoPrecioValue" />
                    <label for="rangoPrecio" class="text-sm">${{ $maxPrecio }}</label>
                </div>
                <div class="w-full text-center">
                    <span id="rangoPrecioValue" aria-live="polite" class="font-bold">${{ request('rangoPrecio', $maxPrecio) }}</span>
                </div>
                <button type="submit" class="w-full mt-4 p-2 text-white rounded-lg bg-orange-500 hover:bg-orange-700">Filtrar</button>
            </form>
        </div>
        <div class="rounded-lg shadow-lg bg-white p-6 mr-5 max-w-4xl flex-1">
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

<script>
    (function(){
        const rango = document.getElementById('rangoPrecio');
        const salida = document.getElementById('rangoPrecioValue');
        if(rango && salida){
            // formatea el número con separador de miles si quieres
            const format = (v) => '$' + Number(v).toLocaleString();
            // actualizar al mover
            rango.addEventListener('input', function(e){
                salida.textContent = '$' + Number(e.target.value).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            });
            // asegurar valor inicial
            salida.textContent = format(rango.value);
        }
    })();
</script>
