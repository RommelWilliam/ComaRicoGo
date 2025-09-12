<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Usuarios y Roles</title>
    @vite('resources/css/app.css')
    @Vite('resources/js/gestionUsuarios.js')
</head>
<body>
    <x-top_bar/>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
     <div class="flex">
        <x-side_bar/>
        <div id="agregarUsuarioModal" class="hidden">
            <x-agegarUsuario :roles="$roles"/>  
        </div>
        <div id="editarUsuarioModal" class="hidden">
            <x-editarUsuario :roles="$roles"/>
        </div>
        <div class="container p-10">
            <h1 class="text-2xl font-bold mb-4">Gestión de usuarios y roles</h1>
            <button 
                onclick="document.getElementById('agregarUsuarioModal').classList.remove('hidden');" 
                class="mb-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            >
                Crear usuario
            </button>
            <button 
                onclick="document.getElementById('agregarRolModal').classList.remove('hidden');" 
                class="mb-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            >
                Crear rol
            </button>
            <div class="flex w-full">
                <button id="usuariosTab" class="bg-white border border-b-0 border-slate-400 text-lg p-3">Usuarios</button>
                <button id="rolesTab" class="bg-white text-lg p-3">Roles</button>
            </div>
            <div id="tablaUsuarios" class="flex-1">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Nombre de usuario</th>
                            <th class="py-2 px-4 border-b">Correo</th>
                            <th class="py-2 px-4 border-b">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr class="hover:bg-orange-100">
                            <td class="py-2 px-4 border-b">{{ $usuario->nombre }}</td>
                            <td class="py-2 px-4 border-b text-ellipsis">{{ $usuario->correo }}</td>
                            <td class="py-2 px-4 border-b">{{ $usuario->rol_nombre }}</td>
                            <td class="py-2 px-4 border-b flex gap-2">
                                <button value="{{ $usuario->id }}" class="BTN_EDIT bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Editar</button>
                                <form action="{{ route("negocio.admin.eliminar_usuario") }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="agregarRolModal" class="hidden">
                <x-rolModal/>
            </div>
            <div id="editarRolModal" class="hidden">
                <x-rolModal type="editar"/>
            </div>         
            <div id="tablaRoles" class="flex-1 hidden">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Nombre de rol</th>
                            <th class="py-2 px-4 border-b">Nivel de permisos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $rol)
                        <tr class="hover:bg-orange-100">
                            <td class="py-2 px-4 border-b">{{ $rol->nombre }}</td>
                            @switch($rol->nivel_permisos)
                                @case(1)
                                <td class="py-2 px-4 border-b text-ellipsis">1 - Control Total</td>
                                    @break
                                @case(2)
                                <td class="py-2 px-4 border-b text-ellipsis">2 - Acceso a cocina</td>
                                @default
                                    
                            @endswitch ($rol->nivel_permisos == 1)
                            <td class="py-2 px-4 border-b flex gap-2">
                                <button value="{{ $rol->id }}" class="BTN_EDIT_ROL bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Editar</button>
                                <form action="{{ route("negocio.admin.eliminar_rol") }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este rol?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="rol_id" value="{{ $rol->id }}">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                </form>
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