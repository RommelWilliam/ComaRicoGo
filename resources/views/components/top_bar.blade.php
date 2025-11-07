<div class="flex justify-between items-center w-full h-16 bg-white shadow-md px-4 py-10 sticky top-0 z-50">
    <a href="/menu" class="text-2xl font-bold text-orange-500 max-md:text-base">COMARICO GO!</a>
    
    @if (session()->has('cliente_id'))
        {{-- 🔍 Mostrar buscador solo en la página del menú --}}
        @if (request()->is('menu'))
            <form class="flex justify-stretch flex-1 mx-8 max-w-3xl max-md:mx-2">
                <input type="text" id="producto_buscado" 
                   class="flex-1 h-10 px-4 border-2 border-gray-300 rounded-s-lg outline-none max-md:w-10 focus:border-orange-500"
                   placeholder="Buscar platillo...">
                <button class="px-4 py-2 bg-orange-500 text-white rounded-e-lg hover:bg-orange-600">Buscar</button>
            </form>
        @endif
    @else
        <h1 class="text-3xl text-bg-gray-900">ADMINISTRACIÓN</h1>
    @endif
    
    <div class="flex">
        @if (session()->has('cliente_id'))
        <a href="{{ route('cliente.ordenes') }}" class="flex flex-col items-center">

            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-md:w-auto max-md:h-fill hover:text-orange-500">
                <path d="M4 21C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="ml-4 text-lg text-gray-700 hover:text-orange-500 hover:underline max-md:hidden">Mi Historial</span>
        <a href="{{ url('/perfil') }}" class="flex flex-col items-center ml-6">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="max-md:w-auto max-md:h-fill hover:text-orange-500">
                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" 
                    stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22" 
                    stroke="#121212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="ml-4 text-lg text-gray-700 hover:text-orange-500 hover:underline max-md:hidden">Perfil</span>
        </a>
        @endif
        <a href="{{ route('logout') }}" class="flex flex-col items-center">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="ml-4 text-lg text-gray-700 hover:text-orange-500 hover:underline max-md:hidden">Cerrar Sesión</span>
        </a>
    </div>
</div>