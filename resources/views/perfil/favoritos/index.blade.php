<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis favoritos</title>

    {{-- Carga tus assets (Tailwind/JS) para que el nav y los estilos se vean bien --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{font-family:'Inter',system-ui,-apple-system,sans-serif;background:#f9fafb;margin:0;color:#1f2937}
        main{padding:1.5rem;max-width:1000px;margin:0 auto}
        .page-header{display:flex;justify-content:space-between;align-items:center;margin:.5rem 0 1.25rem}
        .title{font-size:1.8rem;font-weight:700;color:#111827}
        .btn-prim{background:#f59e0b;color:#fff;padding:.55rem 1rem;border-radius:.5rem;font-weight:600;text-decoration:none;box-shadow:0 2px 5px rgba(0,0,0,.1);transition:background .2s}
        .btn-prim:hover{background:#d97706}

        .fav-card{background:#fff;border-radius:.75rem;box-shadow:0 2px 6px rgba(0,0,0,.08);padding:1rem 1.25rem;border-left:6px solid #f59e0b}
        .fav-head{display:flex;justify-content:space-between;gap:.75rem;align-items:flex-start}
        .fav-name{font-weight:700;color:#111827}
        .fav-meta{color:#6b7280;font-size:.9rem;margin-top:.15rem}
        .fav-actions{display:flex;gap:.5rem;flex-wrap:wrap}
        .btn-blue{background:#2563eb;color:#fff;border:0;border-radius:.5rem;padding:.45rem .8rem;font-weight:600;cursor:pointer}
        .btn-blue:hover{background:#1d4ed8}
        .btn-red{background:#ef4444;color:#fff;border:0;border-radius:.5rem;padding:.45rem .8rem;font-weight:600;cursor:pointer}
        .btn-red:hover{background:#dc2626}

        .items{margin:.5rem 0 0;padding-left:1.1rem}
        .items li{margin:.2rem 0}

        .empty{background:#fff;border-radius:.75rem;border:1px dashed #d1d5db;padding:2rem;text-align:center;color:#6b7280}
        .empty .cta{margin-top:1rem;display:inline-block}

        .total{margin-top:.5rem;text-align:right;font-weight:700;color:#111827}
        .muted{color:#6b7280}
        .warn{color:#9ca3af;font-style:italic}

        .toast{position:fixed;right:16px;top:16px;z-index:9999;min-width:260px;padding:12px 14px;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.15);color:#0b3b2e;background:#d1fae5;display:none;align-items:center;gap:8px;font-weight:600}
        .toast.error{background:#fee2e2;color:#7f1d1d}
        .toast .close{margin-left:auto;cursor:pointer;font-weight:700;opacity:.6}
        .toast .close:hover{opacity:1}
        .grid-favs{display:grid;grid-template-columns:1fr;gap:1rem}
        @media (min-width: 880px){.grid-favs{grid-template-columns:1fr}}
    </style>
</head>
<body>

    {{-- NAV superior general --}}
    @include('components.top_bar')

    {{-- Toast para mensajes flash --}}
    <div id="toast" class="toast" role="status" aria-live="polite">
        <span id="toast-text">Acción realizada.</span>
        <span class="close" onclick="(function(){document.getElementById('toast').style.display='none'})()">×</span>
    </div>

    <main>

        @if ($favoritos->isEmpty())
            <div class="empty">
                <div style="font-weight:700;color:#111827;margin-bottom:.25rem;">Aún no tienes favoritos</div>
                Guarda tus pedidos finalizados como favoritos para repetirlos más rápido.
                <div class="cta">
                    <a href="{{ url('/menu') }}" class="btn-prim">Ir al menú</a>
                </div>
            </div>
        @else
            <div class="grid-favs">
                @foreach ($favoritos as $fav)
                    <div class="fav-card">
                        <div class="fav-head">
                            <div>
                                <div class="fav-name">{{ $fav->nombre ?? 'Favorito sin nombre' }}</div>
                                <div class="fav-meta">
                                    Guardado el {{ optional($fav->created_at)->format('d/m/Y H:i') }}
                                    @if($fav->source_order_id)
                                        — origen: Orden #{{ $fav->source_order_id }}
                                    @endif
                                </div>
                            </div>

                            <div class="fav-actions">
                                {{-- Repetir pedido --}}
                                <form action="{{ route('favoritos.repeat', $fav->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-blue">Repetir pedido</button>
                                </form>

                                {{-- Eliminar favorito --}}
                                <form action="{{ route('favoritos.destroy', $fav->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este favorito?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-red">Eliminar</button>
                                </form>
                            </div>
                        </div>

                        <div style="margin-top:.5rem">
                            <div style="font-weight:600;color:#374151;margin-bottom:.25rem">Contenido:</div>

                            @php $totalActual = 0; @endphp
                            <ul class="items">
                                @foreach ($fav->items as $item)
                                    @php
                                        $nombre   = $item->platillo->nombre ?? 'Platillo eliminado';
                                        $precio   = $item->platillo->precio ?? null;  // precio ACTUAL
                                        $cantidad = (int) $item->cantidad;
                                        $subtotal = !is_null($precio) ? ($precio * $cantidad) : null;
                                        if (!is_null($subtotal)) { $totalActual += $subtotal; }
                                    @endphp

                                    <li>
                                        🍽️ {{ $nombre }} × {{ $cantidad }}
                                        @if(!is_null($precio))
                                            — <span class="muted">Precio:</span> ${{ number_format($precio, 2) }}
                                            — <strong>Subtotal:</strong> ${{ number_format($subtotal, 2) }}
                                        @else
                                            — <span class="warn">sin precio (eliminado/no disponible)</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                            <div class="total">
                                Total estimado: ${{ number_format($totalActual, 2) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación si aplica --}}
            @if(method_exists($favoritos, 'links'))
                <div style="margin-top:1rem;">
                    {{ $favoritos->links() }}
                </div>
            @endif
        @endif
    </main>

    <script>
        // Mostrar toast si hay flash de Laravel
        (function(){
            const t = document.getElementById('toast');
            const txt = document.getElementById('toast-text');
            @if (session('success'))
                txt.textContent = @json(session('success'));
                t.classList.remove('error'); t.style.display='flex';
                setTimeout(()=> t.style.display='none', 4000);
            @endif
            @if (session('error'))
                txt.textContent = @json(session('error'));
                t.classList.add('error'); t.style.display='flex';
                setTimeout(()=> t.style.display='none', 4000);
            @endif
        })();
    </script>
</body>
</html>
