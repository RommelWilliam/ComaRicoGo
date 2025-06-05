<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Cliente</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h2 class="text-3xl font-bold underline">Iniciar Sesión</h2>

   @if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

    <form method="POST" action="{{ route('login.cliente') }}">
        @csrf
        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>