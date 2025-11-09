@extends('layouts.cocinero')

@section('title', 'Órdenes Pendientes')

@section('contenido')
@Vite(['resources/css/app.css'])
    <h1 class="text-2xl font-bold mb-4 text-center">Órdenes Pendientes</h1>

    @if($notificaciones->isNotEmpty())
        <div class="mb-6">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-4">
                <div class="flex justify-between items-start mb-2">
                    <h2 class="font-bold">¡Nuevas Órdenes!</h2>
                </div>
                @foreach($notificaciones as $notificacion)
                    <div id="notification-{{ $notificacion->id }}" 
                         class="mb-2 pl-2 border-l-2 border-orange-300 bg-orange-50 p-3 rounded relative transition-all duration-300 ease-in-out">
                        <button onclick="closeNotification('{{ $notificacion->id }}')" 
                                class="absolute top-2 right-2 text-orange-700 hover:text-orange-900 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <p class="pr-6">{{ $notificacion->data['mensaje'] }}</p>
                        <p class="text-sm text-gray-600">Total: ${{ $notificacion->data['total'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            function closeNotification(id) {
                const notification = document.getElementById('notification-' + id);
                notification.style.opacity = '0';
                notification.style.maxHeight = '0';
                notification.style.marginBottom = '0';
                notification.style.padding = '0';
                
                setTimeout(() => {
                    notification.style.display = 'none';
                    
                    // Si no quedan más notificaciones visibles, ocultar el contenedor
                    const container = notification.closest('.mb-6');
                    const visibleNotifications = container.querySelectorAll('[id^="notification-"]:not([style*="display: none"])');
                    if (visibleNotifications.length === 0) {
                        container.style.display = 'none';
                    }
                }, 300);
            }
        </script>
    @endif

    @if($ordenes->isEmpty())
        <p class="text-gray-600 text-center">No hay órdenes pendientes.</p>
    @else
        <ul class="space-y-4 flex flex-wrap gap-6 justify-center">
            @foreach($ordenes as $orden)
                <li class="p-4 bg-white shadow-lg rounded-lg hover:scale-105 hover:border hover:border-orange-400 transition-transform">
                    <div class="flex justify-between items-center">
                        <div>
                            <strong class="text-lg">Orden #{{ $orden->id }}</strong>  
                            <span class="ml-2 text-gray-700 font-semibold">
                                ${{ $orden->total }}
                            </span>
                            <div class="mt-2">
                                <u>Platillos:</u>
                                <ul class="list-disc list-inside text-gray-600">
                                    @foreach($orden->platillos as $platillo)
                                        <li>{{ $platillo->nombre }} (x{{ $platillo->pivot->cantidad }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cocinero.asignarOrden', $orden->id) }}">
                            @csrf
                            <button type="submit" 
                                class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
                                Asignarme esta orden
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
