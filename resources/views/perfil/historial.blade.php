{{-- Mostrar botón solo si la orden está finalizada --}}
@if (($orden->estado ?? null) === 'finalizada')
    <form action="{{ route('favoritos.storeFromOrder', $orden->id) }}" method="POST" class="mt-2 flex gap-2">
        @csrf
        <input type="text"
               name="nombre"
               placeholder="Nombre (opcional)"
               class="border rounded px-2 py-1 text-sm"
               maxlength="100" />
        <button type="submit" class="px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700 text-sm">
            Guardar como favorito
        </button>
    </form>
@endif
