<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil de usuario</title>
    @Vite('resources/css/app.css')

</head>
<body class="h-screen">
    <x-top_bar/>
    <div class="bg-gray-200 p-4 h-full flex justify-center">
        {{-- Historial de órdenes --}}
        <div class="rounded-lg shadow-lg bg-white p-6 mr-5 max-w-4xl flex-1 h-fit flex flex-col items-center">
            <h1 class="text-2xl font-bold text-center uppercase">Historial de Órdenes</h1>
            <table class="w-full border-collapse border border-gray-400 my-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-4"># Orden</th>
                        <th class="px-4 py-4">Fecha</th>
                        <th class="px-4 py-4">Total</th>
                        <th class="px-4 py-4">Estado</th>
                        <th class="px-4 py-4">Platillos</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1 @endphp
                    @forelse($ordenes as $order)
                        <tr class="text-center border border-gray-300 hover:bg-orange-100
                        @if ($count % 2 == 0) bg-gray-100 @endif">
                            <td class="px-4 py-4">{{ $order->id }}</td>
                            <td class="px-4 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-4">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-4 uppercase">{{ $order->estado }}</td>
                            <td class="px-4 py-4 text-left">
                                <ul>
                                @foreach ($order->platillosVista as $platillo)
                                    <li>{{ $platillo->nombre }}<strong class="mx-2">({{ $platillo->cantidad }})</strong></li>
                                @endforeach
                                <!--<a href="" class="btn btn-sm btn-primary">Ver Detalles</a>-->
                                </ul>
                            </td>
                        </tr>
                        @php $count++ @endphp
                    @empty
                        <tr>
                            <td colspan="5">No tienes órdenes registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="/menu" class="p-4 text-white rounded-lg bg-orange-500 hover:bg-orange-700 font-bold">Regresar a Inicio</a>
        </div>

        {{-- Detalles del usuario --}}
        <div class="border border-gray-200 shadow-lg bg-white rounded-lg mr-5 p-4 w-fit max-h-fit">
            <div class="">
                <div class="font-bold uppercase mb-2 text-center">
                    <h5>Detalles del Usuario</h5>
                </div>
                <div class="px-3">
                    <p class="my-3"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                    <p class="my-3"><strong>Email:</strong> {{ $cliente->correo }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
