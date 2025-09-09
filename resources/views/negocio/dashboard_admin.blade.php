<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-top_bar/>
    <div class="flex">
        <x-side_bar/>
        <div class="p-10 flex-1">
            <h1>DASHBOARD ADMIN</h1>
            <a href="{{ route("negocio.admin.gestion_menu") }}" class="text-xl text-bg-slate-800">Gestionar Platillos</a>
        </div>
    </div>
</body>
</html>