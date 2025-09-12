<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión del menú</title>
    @Vite('resources/css/app.css')
    @Vite('resources/js/gestionMenu.js')
</head>
<body>
    <x-top_bar/>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    <div id="agregarPlatilloModal" class="hidden">
        <x-agregarPlatillo/>
    </div>
    <div id="editarPlatilloModal" class="hidden">
        <x-editarPlatillo/>
    </div>
    <div class="flex">
        <x-side_bar/>  
        <div class="container p-10 overflow-scroll h-screen">
            <h1 class="text-2xl font-bold mb-4">Gestión del Menú</h1>
            <button 
                onclick="document.getElementById('agregarPlatilloModal').classList.remove('hidden');" 
                class="mb-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            >
                Agregar platillo
            </button>
            <div class="flex w-full">
                <button id="categoriaDisponibles" class="bg-white border border-b-0 border-slate-400 text-lg p-3">Disponibles</button>
                <button id="categoriaNoDisponibles" class="bg-white text-lg p-3">No Disponibles</button>
            </div>         
            <div  class="flex-1">
                <table class="min-w-full bg-white border border-gray-200 max-w-5xl">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Imágen</th>
                            <th class="py-2 px-4 border-b">Nombre de Producto</th>
                            <th class="py-2 px-4 border-b">Descripción</th>
                            <th class="py-2 px-4 border-b">Cantidad</th>
                            <th class="py-2 px-4 border-b">Precio</th>
                            <th class="py-2 px-4 border-b">Disponibilidad</th>
                            <th class="py-2 px-4 border-b"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($platillos as $platillo)
                        @if ($platillo->disponible > 0)   
                        <tr class="platillosDisp hover:bg-orange-100">
                            <td class="py-2 px-4 border-b">
                                @if ($platillo->img)
                                <img src="{{ asset('platillos/' . $platillo->img) }}" alt="Imagen de {{ $platillo->nombre }}" class="w-16 h-16 object-cover rounded">    
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $platillo->nombre }}</td>
                            <td class="py-2 px-4 border-b text-ellipsis">{{ $platillo->descripcion }}</td>
                            <td class="py-2 px-4 border-b">{{ $platillo->cantidad }} unidades</td>
                            <td class="py-2 px-4 border-b">${{ number_format($platillo->precio, 2) }}</td>
                            <td class="py-2 px-4 border-b">
                                    <span class="text-green-600 font-semibold">Disponible</span>
                            </td>
                            <td class="py-2 px-4 border-b flex h-full">
                                <button value="{{ $platillo->id }}" class="BTN_EDIT bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Editar</button>
                                <form action="{{ route("negocio.admin.eliminar_platillo") }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este platillo?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="platillo_id" value="{{ $platillo->id }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @else
                        <tr class="platillosNoDisp hover:bg-orange-100 hidden">
                            <td class="py-2 px-4 border-b">
                                @if ($platillo->img)
                                <img src="{{ asset('platillos/' . $platillo->img) }}" alt="Imagen de {{ $platillo->nombre }}" class="w-16 h-16 object-cover rounded">    
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $platillo->nombre }}</td>
                            <td class="py-2 px-4 border-b text-ellipsis">{{ $platillo->descripcion }}</td>
                            <td class="py-2 px-4 border-b">{{ $platillo->cantidad }} unidades</td>
                            <td class="py-2 px-4 border-b">${{ number_format($platillo->precio, 2) }}</td>
                            <td class="py-2 px-4 border-b">
                                <span class="text-red-600 font-semibold">No disponible</span>
                            </td>
                            <td class="py-2 px-4 border-b flex gap-2">
                                <button value="{{ $platillo->id }}" class="BTN_EDIT bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Editar</button>
                                <form action="{{ route("negocio.admin.eliminar_platillo") }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este platillo?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="platillo_id" value="{{ $platillo->id }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</body>
</html>