@props(['type' => 'crear'])
@if ($type == 'crear')
<form action="{{ route('negocio.admin.crear_rol') }}" method="POST" class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    @csrf
    <h2 class="text-2xl font-bold mb-6 text-center">Agregar Nuevo Rol</h2>
    <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
        <input type="text" name="nombre" id="rolNombre" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nivel de Permisos:</label>
        <input type="number" max="2" min="1" step="1" name="nivelPermisos" id="nivelPermsisos" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            Agregar Rol
        </button>
    </div>
</form>    
@else
<form action="{{ route('negocio.admin.actualizar_rol') }}" method="POST" class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    <h2 class="text-2xl font-bold mb-6 text-center">Editar Rol</h2>
    <div class="mb-4">
        <input type="hidden" name="id" id="rolIdEdit">
        <label for="nombreEdit" class="block text-gray-700 font-bold mb-2">Nombre:</label>
        <input type="text" name="nombre" id="rolNombreEdit" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nivel de Permisos:</label>
        <input type="number" max="2" min="1" step="1" name="nivelPermisos" id="rolNivelPermsisosEdit" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            Guardar Cambios
        </button>
    </div>
</form>
@endif