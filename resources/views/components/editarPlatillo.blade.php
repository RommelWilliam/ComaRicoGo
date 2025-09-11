<form class="bg-white p-6 rounded-lg shadow-lg w-96" enctype="multipart/form-data"
 action="{{ route('negocio.admin.actualizar_platillo') }}" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-lg text-center my-3 font-bold">Editar platillo</h3>
    <input type="hidden" id="platilloIdEdit" name="platilloId" />
    <div class="mb-3">
        <input type="file" name="img" alt="Imágen del producto" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
    </div>
    <div class="mb-3">
        <label for="nombrePlatillo" class="form-label">Nombre del Platillo</label>
        <input type="text" id="nombrePlatilloEdit" name="nombrePlatillo" required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
    </div>
    <div class="mb-3">
        <label for="descripcionPlatillo" class="form-label ">Descripción</label>
        <input type="text" id="descripcionPlatilloEdit" name="descripcionPlatillo" required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
    </div>
    <div class="mb-3">
        <label for="precioPlatillo" class="form-label">Precio del Platillo</label>
        <input type="number" min="0.00" step="0.01" id="precioPlatilloEdit" name="precioPlatillo" required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
    </div>
    <div class="mb-3">
        <label for="cantidadPlatillo" class="form-label">Cantidad disponible</label>
        <input type="number" min="0" step="1" id="cantidadPlatilloEdit" name="cantidadPlatillo" required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
    </div>
    <div class="mb-3">
        <input type="checkbox" id="disponiblePlatilloEdit" name="disponible"
        class=" px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"/>
        <label for="disponible" class="form-label ">Disponible para ordenar</label>
    </div>
    <div class="w-full content-center my-4">
        <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded w-full">Guardar Cambios</button>
    </div>

</form>