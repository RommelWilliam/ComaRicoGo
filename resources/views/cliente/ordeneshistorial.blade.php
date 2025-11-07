<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Órdenes</title>
    {{-- 🔹 Carga Tailwind/JS de tu app (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }

        main {
            padding: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .btn-favoritos {
            background: #f59e0b;
            color: #fff;
            padding: .6rem 1rem;
            border-radius: .5rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background .2s ease;
        }

        .btn-favoritos:hover {
            background: #d97706;
        }

        .orden-card {
            background: #fff;
            border-radius: .75rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            padding: 1.25rem 1.5rem;
            border-left: 6px solid #f59e0b;
        }

        .orden-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .5rem;
        }

        .orden-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
        }

        .orden-meta {
            color: #6b7280;
            font-size: .95rem;
            margin-bottom: .5rem;
        }

        .estado {
            display: inline-block;
            font-weight: 600;
            color: #059669;
            background: #d1fae5;
            padding: .25rem .6rem;
            border-radius: .375rem;
            font-size: .9rem;
        }

        .platillos {
            margin: .75rem 0;
            padding-left: 1rem;
        }

        .platillos li {
            margin-bottom: .25rem;
            font-size: .95rem;
        }

        .guardar-fav {
            margin-top: 1rem;
        }
    </style>
</head>
<body>

    {{-- 🔹 Navbar general del cliente --}}
    @include('components.top_bar')

    <main>
        <div class="header">
            <h1>Historial de Órdenes</h1>
            <a href="{{ route('perfil.favoritos') }}" class="btn-favoritos">⭐ Ver mis favoritos</a>
        </div>

        @if($ordenes->isEmpty())
            <p>No tienes órdenes registradas aún.</p>
        @else
            @foreach($ordenes as $orden)
                <div class="orden-card">
                    <div class="orden-header">
                        <h2>Orden #{{ $orden->id }}</h2>
                        <span class="estado">
                            @if($orden->estado == 'pendiente') 🕒 Recibida
                            @elseif($orden->estado == 'en_proceso') 👨‍🍳 En preparación
                            @elseif($orden->estado == 'finalizada') ✅ Lista para recoger
                            @else ❓ Desconocido
                            @endif
                        </span>
                    </div>

                    <p class="orden-meta">
                        <strong>Fecha:</strong> {{ $orden->created_at->format('d/m/Y H:i') }}<br>
                        <strong>Total:</strong> ${{ number_format($orden->total, 2) }}
                    </p>

                    <h3 style="margin-top:.5rem;">Platillos:</h3>
                    <ul class="platillos">
                        @foreach($orden->platillos as $platillo)
                            <li>
                                🍽️ {{ $platillo->nombre }} — Cantidad: {{ $platillo->pivot->cantidad }} —
                                <strong>Subtotal:</strong> ${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}
                            </li>
                        @endforeach
                    </ul>

                    {{-- Mostrar el botón o estado de favorito --}}
                    <div class="guardar-fav">
                        <x-guardar-favorito :orden="$orden" />
                    </div>
                </div>
            @endforeach
        @endif
    </main>
</body>
</html>
