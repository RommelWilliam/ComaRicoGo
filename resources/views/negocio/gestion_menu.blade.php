<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión del menú</title>
    @Vite('resources/css/app.css')
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
    <div id="agregarPlatilloModal" class="hidden">
        <x-agregarPlatillo_modal/>
    </div>
    
    <div class="flex">
        <x-side_bar/>  
        <div class="container p-10">
            <h1 class="text-2xl font-bold mb-4">Gestión del Menú</h1>
            <button 
                onclick="document.getElementById('agregarPlatilloModal').classList.remove('hidden');" 
                class="mb-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            >
                Agregar platillo
            </button>

            <script>
                // Centrar y mostrar el modal sobre los demás elementos
                const modal = document.getElementById('agregarPlatilloModal');
                modal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            </script>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nombre de Producto</th>
                        <th class="py-2 px-4 border-b">Descripción</th>
                        <th class="py-2 px-4 border-b">Precio</th>
                        <th class="py-2 px-4 border-b">Disponibilidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platillos as $platillo)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $platillo->nombre }}</td>
                        <td class="py-2 px-4 border-b">{{ $platillo->descripcion }}</td>
                        <td class="py-2 px-4 border-b">${{ number_format($platillo->precio, 2) }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($platillo->disponible)
                                <span class="text-green-600 font-semibold">Disponible</span>
                            @else
                                <span class="text-red-600 font-semibold">No disponible</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b flex gap-2">
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Editar</a>
                            <form action="{{ route("negocio.admin.eliminar_platillo") }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este platillo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   
</body>
</html>