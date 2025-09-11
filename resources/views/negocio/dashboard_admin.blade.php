<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen">
    <x-top_bar/>
    <div class="flex">
        <x-side_bar/>
        <div class="p-10 flex-1 h-full">
            <div>DASHBOARD ADMIN</div>
            <div class="my-10">
                <a href="{{ route("negocio.admin.gestion_menu") }}" class="my-5 p-5 text-xl text-bg-slate-800 border border-slate-600">Gestionar Menú</a>
                <a href="{{ route("negocio.admin.gestion_usuarios_roles") }}" class="my-2 p-5 text-xl text-bg-slate-800 border border-slate-600">Gestionar Usuarios</a>
            </div>
            
        </div>
    </div>
</body>
</html>