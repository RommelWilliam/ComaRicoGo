@props(['roles'])

<form action="{{ route('negocio.admin.actualizar_usuario') }}" method="POST" class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <input type="hidden" name="usuario_id" id="usuarioIdEdit">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
        <input type="text" name="nombre" id="usuarioNombreEdit"
         class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label for="correo" class="block text-gray-700 font-bold mb-2">Correo electrónico:</label>
        <input type="email" name="correo" id="usuarioCorreoEdit"
         class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
        <input type="password" name="password" id="usuarioPasswordEdit"
         class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-6">
        <label for="rol" class="block text-gray-700 font-bold mb-2">Rol:</label>
        <select name="rol_id" id="usuarioRolEdit" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            @foreach ($roles as $rol)
            <option value="{{ $rol->id }}">{{$rol->nombre}}</option>    
            @endforeach
        </select>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            Actualizar Usuario
        </button>
    </div>
</form>