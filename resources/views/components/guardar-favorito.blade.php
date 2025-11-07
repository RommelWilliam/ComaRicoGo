@props(['orden'])

@php
    $finalizada = (($orden->estado ?? '') === 'finalizada');
    $clienteId  = session('cliente_id');

    // ya guardado por duplicado directo (source_order_id)
    $yaGuardado = false;
    if ($finalizada && $clienteId) {
        $yaGuardado = \App\Models\Favorito::where('cliente_id', $clienteId)
            ->where('source_order_id', $orden->id)
            ->exists();
    }

    // proveniente de favorito (no permitir guardar)
    $vieneDeFavorito = !empty($orden->favorito_origen_id);

    $uid = 'fav_' . $orden->id;
@endphp

@if ($finalizada)
  @if ($yaGuardado || $vieneDeFavorito)
    <div style="display:flex;gap:.5rem;align-items:center;margin-top:.5rem;">
        <input type="text" value="Ya guardado en Favoritos"
               readonly
               style="padding:.35rem .5rem;border:1px solid #d1d5db;border-radius:.375rem;background:#f9fafb;color:#6b7280;width:220px">
        <button type="button"
                disabled
                title="Este pedido ya está en tus favoritos"
                style="padding:.4rem .6rem;border-radius:.375rem;background:#9ca3af;color:#fff;border:0;cursor:not-allowed">
            Guardado ✓
        </button>
    </div>
  @else
    <form id="{{ $uid }}_form"
          action="{{ route('favoritos.storeFromOrder', $orden->id) }}"
          method="POST"
          style="display:flex;gap:.5rem;align-items:center;margin-top:.5rem;">
      @csrf
      <input type="text" name="nombre" placeholder="Nombre (opcional)" maxlength="100"
             style="padding:.35rem .5rem;border:1px solid #d1d5db;border-radius:.375rem;min-width:220px">
      <button id="{{ $uid }}_btn" type="submit"
              style="padding:.4rem .6rem;border-radius:.375rem;background:#059669;color:#fff;border:0;cursor:pointer">
        Guardar como favorito
      </button>
    </form>
    <script>
      (function(){
        const form = document.getElementById('{{ $uid }}_form');
        const btn  = document.getElementById('{{ $uid }}_btn');
        if (!form || !btn) return;
        form.addEventListener('submit', function(){
          btn.disabled = true;
          btn.style.background = '#10b981';
          btn.textContent = 'Guardando…';
        });
      })();
    </script>
  @endif
@endif
