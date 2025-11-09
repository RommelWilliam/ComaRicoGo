<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Cocinero - Sistema de Pedidos')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }
        nav {
            background: #333;
            padding: 10px;
        }
        nav a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .contenido {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('cocinero.ordenesPendientes') }}">Órdenes Pendientes</a> |
        <a href="{{ route('cocinero.ordenesAsignadas') }}">Mis Órdenes</a> |
        <a href="{{ route('cocinero.ordenesFinalizadas') }}">Órdenes Finalizadas</a> |
        <a href="{{ route('cocinero.reportes') }}">Reportar Falla</a> |
        <a href="{{ route('logout') }}">Cerrar Sesión</a>
    </nav>

    <div class="contenido">
        @yield('contenido')
    </div>
</body>
</html>
