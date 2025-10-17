<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial de órdenes</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-top_bar />
    <div class="flex">
        <x-side_bar />
        <div class="ml-10 p-4">
            <h1 class="text-2xl font-bold mb-4">Historial de Órdenes</h1>
            <p>Aquí puedes ver el historial de órdenes.</p>
            <div class="mt-4 max-h-[calc(100vh-8rem)] overflow-y-auto border border-gray-200">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">ID de Orden</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Cliente</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Total</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Cocinero</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Estado</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Fecha Creación</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Fecha Finalizado</th>
                            <th class="border px-4 py-2 sticky top-0 bg-white z-10">Tiempo preparación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenes as $orden)
                            <tr>
                                <td class="border px-4 py-2">{{ $orden->id }}</td>
                                <td class="border px-4 py-2">{{ $orden->cliente->nombre }}</td>
                                <td class="border px-4 py-2">${{ number_format($orden->total, 2) }}</td>
                                <td class="border px-4 py-2">{{ $orden->cocinero ? $orden->cocinero->nombre : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $orden->estado }}</td>
                                <td class="border px-4 py-2">{{ $orden->created_at }}</td>
                                <td class="border px-4 py-2">{{ $orden->fecha_finalizado ? $orden->fecha_finalizado : 'N/A' }}</td>
                                <td class="border px-4 py-2">
                                    @if ($orden->fecha_finalizado)
                                        @php
                                            $fechaFinalizado = $orden->fecha_finalizado instanceof \Carbon\Carbon
                                                ? $orden->fecha_finalizado
                                                : \Carbon\Carbon::parse($orden->fecha_finalizado);

                                            $updatedAt = $orden->updated_at instanceof \Carbon\Carbon
                                                ? $orden->updated_at
                                                : (is_numeric($orden->updated_at)
                                                    ? \Carbon\Carbon::createFromTimestamp($orden->updated_at)
                                                    : \Carbon\Carbon::parse($orden->updated_at));

                                            $diffMinutes = $fechaFinalizado->diffInMinutes($updatedAt);
                                        @endphp
                                        {{ $diffMinutes }} minutos
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</body>
</html>