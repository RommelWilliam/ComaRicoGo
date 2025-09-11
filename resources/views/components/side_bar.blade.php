@php
    // Optional: set a default state for sidebar open/closed
@endphp

<div x-data="{ open: true }" class="flex max-h-screen">
    <!-- Burger Button -->
    <button 
        @click="open = !open" 
        class="p-2 m-2 text-white bg-gray-800 rounded-md focus:outline-none md:hidden"
        aria-label="Toggle sidebar"
    >
        <!-- Burger icon -->
        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Close icon -->
        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Sidebar -->
    <aside 
        x-show="open"
        class="w-64 h-screen bg-gray-800 text-white flex flex-col transition-all duration-300 z-20 fixed md:static"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-full"
    >
        <nav class="flex-1 p-4">
            <ul>
                <li class="mb-4">
                    <a href="{{ route("negocio.admin.gestion_menu") }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Gestión de Menú
                    </a>
                </li>
                <li>
                    <a href="{{ route("negocio.admin.gestion_usuarios_roles") }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Gestión de Usuarios y roles
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</div>

<!-- Alpine.js CDN (add this if not already included in your layout) -->
<script src="//unpkg.com/alpinejs" defer></script>