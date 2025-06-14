<div class="flex justify-between items-center w-full h-16 bg-white shadow-md px-4 py-10 sticky top-0 z-50">
    <a href="/menu" class="text-2xl font-bold text-orange-500 max-md:text-base">COMARICO GO!</a>
    <form class="flex justify-stretch flex-1 mx-8 max-w-3xl max-md:mx-2">
        <input type="text" id="producto_buscado" class="flex-1 h-10 px-4 border-2 border-gray-300 rounded-s-lg outline-none max-md:w-10 focus:border-orange-500" placeholder="Buscar platillo...">
        <button class=" px-4 py-2 bg-orange-500 text-white rounded-e-lg hover:bg-orange-600">Buscar</button>
    </form>
    <a href="{{ route('logout') }}" class="flex items-center">
        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-md:w-auto max-md:h-fill hover:text-orange-500">
            <path d="M4 21C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="ml-4 text-lg text-gray-700 hover:text-orange-500 hover:underline max-md:hidden">Cerrar Sesión</span>
    </a>
</div>