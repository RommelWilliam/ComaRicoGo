<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    @vite('resources/css/app.css')
</head>
<body class="flex justify-end w-screen h-screen min-h-screen bg-login_img bg-cover bg-no-repeat bg-right 
    max-md:justify-center max-md:items-center max-md:p-8">
    <div class="w-2/5 h-full px-10 flex flex-col justify-center items-stretch rounded-s-2xl bg-white shadow-lg 
        max-md:w-full max-md:rounded-xl max-md:px-5 max-md:py-8 max-md:h-fit">
        <h2 class="text-2xl font-bold uppercase text-center mb-8 max-md:text-xl">REGISTRATE EN COMARICO GO!</h2>
        @if(session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('registrar.cliente') }}">
            @csrf
            <div class="flex justify-stretch border-2 border-gray-300 rounded-lg mb-5 p-2 focus:border-orange-500">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" lass="max-md:w-auto max-md:h-fill">
                    <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" name="nombre" placeholder="Nombre" required 
                class="w-full h-auto text-lg 5 outline-none ms-2">
            </div>
            <div class="flex justify-stretch border-2 border-gray-300 rounded-lg mb-5 p-2 focus:border-orange-500">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-md:w-auto max-md:h-fill">
                    <path d="M4 21C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="email" name="correo" placeholder="Correo" required 
                class="w-full h-auto text-lg 5 outline-none ms-2">
            </div>

            <div class="flex justify-stretch border-2 border-gray-300 rounded-lg mb-5 p-2 focus:border-orange-500">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-md:w-auto max-md:h-fill">
                    <path d="M21.0667 5C21.6586 5.95805 22 7.08604 22 8.29344C22 11.7692 19.1708 14.5869 15.6807 14.5869C15.0439 14.5869 13.5939 14.4405 12.8885 13.8551L12.0067 14.7333C11.272 15.465 11.8598 15.465 12.1537 16.0505C12.1537 16.0505 12.8885 17.075 12.1537 18.0995C11.7128 18.6849 10.4783 19.5045 9.06754 18.0995L8.77362 18.3922C8.77362 18.3922 9.65538 19.4167 8.92058 20.4412C8.4797 21.0267 7.30403 21.6121 6.27531 20.5876C6.22633 20.6364 5.952 20.9096 5.2466 21.6121C4.54119 22.3146 3.67905 21.9048 3.33616 21.6121L2.45441 20.7339C1.63143 19.9143 2.1115 19.0264 2.45441 18.6849L10.0963 11.0743C10.0963 11.0743 9.3615 9.90338 9.3615 8.29344C9.3615 4.81767 12.1907 2 15.6807 2C16.4995 2 17.282 2.15509 18 2.43738" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.8851 8.29353C17.8851 9.50601 16.8982 10.4889 15.6807 10.4889C14.4633 10.4889 13.4763 9.50601 13.4763 8.29353C13.4763 7.08105 14.4633 6.09814 15.6807 6.09814C16.8982 6.09814 17.8851 7.08105 17.8851 8.29353Z" stroke="#1C274C" stroke-width="1.5"/>
                </svg>
                <input type="password" name="password" placeholder="Contraseña" required 
                class="w-full h-auto text-lg 5 outline-none ms-2 ">
            </div>
            <a href="{{ route('login') }}" class="text-center text-orange-500 hover:text-orange-600 hover:underline">¿Ya tienes una cuenta? Inicia sesión</a>

            <button type="submit" class=" w-full p-3 mt-5 text-center uppercase bg-orange-500 rounded-lg text-white hover:bg-orange-600">Registrate</button>
        </form>
    </div>
</body>
</html>