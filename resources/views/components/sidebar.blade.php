<!-- component Sidebar -->
<aside
    class="ml-[-100%] fixed z-50 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[18%] 2xl:w-[15%]">
    <div>
        <div class="py-2 px-1 flex justify-center">
            <a href="#" title="home">
                <div class="flex flex-row items-center self-center">
                    <img src="/img/infotel.png" class="w-12 ml-[-10px]" />
                    <div class="flex flex-col ml-2">
                        <span class="text-base md:text-lg font-bold italic"> Bienvenido al</span>
                        <span class="text-sm md:text-base italic -mt-1"> Panel de Control</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="text-center">
            @if (Auth::user()->profile_photo_path)
                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt=""
                    class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
            @else
                <img class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28"
                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            @endif
            <div class="mt-4 text-lg font-semibold text-gray-600 whitespace-nowrap overflow-hidden text-ellipsis">
                {{ Auth::user()->name }}</div>
            <span class="text-base text-gray-400">Administrador</span>
        </div>

        <ul class="scroll-pos space-y-2 tracking-wide mt-4 h-72 2xl:h-full overflow-y-auto pr-1">
            @role('Administrador')
                <x-sidebar-link href="{{ route('sistema-dashboard') }}" :active="request()->routeIs('sistema-dashboard')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-chart-simple"></i>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-roles') }}" :active="request()->routeIs('sistema-roles')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-unlock-keyhole"></i>
                    </x-slot>
                    {{ __('Accesos') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-categorias') }}" :active="request()->routeIs('sistema-categorias')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-tags"></i>
                    </x-slot>
                    {{ __('Categorias') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-productos') }}" :active="request()->routeIs('sistema-productos')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                    </x-slot>
                    {{ __('Productos') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-banners') }}" :active="request()->routeIs('sistema-banners')">
                    <x-slot name="logo">
                        <i class="fa-regular fa-images"></i>
                    </x-slot>
                    {{ __('Banners') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-videos') }}" :active="request()->routeIs('sistema-videos')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-video"></i>
                    </x-slot>
                    {{ __('Videos') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-categorias') }}" :active="request()->routeIs('mensajes')">
                    <x-slot name="logo">
                        <i class="fa-regular fa-envelope"></i>
                    </x-slot>
                    {{ __('Mensajes') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-usuarios') }}" :active="request()->routeIs('sistema-usuarios')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-users"></i>
                    </x-slot>
                    {{ __('Usuarios') }}
                </x-sidebar-link>
            @endrole
            <x-sidebar-link href="{{ route('sistema-perfil') }}" :active="request()->routeIs('profile.show', 'sistema-perfil')">
                <x-slot name="logo">
                    <i class="fa-solid fa-user-gear"></i>
                </x-slot>
                {{ __('Perfil') }}
            </x-sidebar-link>
        </ul>
    </div>

    <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
        <ul class="w-full">
            <form method="POST" action="{{ route('cerrar-sesion') }}" x-data>
                @csrf

                <x-sidebar-link href="{{ route('cerrar-sesion') }}" @click.prevent="$root.submit();">
                    <x-slot name="logo">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </x-slot>
                    {{ __('Cerrar sesión') }}
                </x-sidebar-link>
            </form>
        </ul>
    </div>
</aside>

{{-- Responsive sidebar --}}
<div x-show="sidebarVisible" @click="sidebarVisible = false"
    class="fixed inset-0 z-50 bg-black bg-opacity-50 lg:hidden">
    <aside x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-show="sidebarVisible"
        @click.away="sidebarVisible = false"
        class="fixed z-50 top-0 pb-3 px-5 w-60 lg:hidden flex flex-col justify-between h-screen border-r bg-white md:w-4/12 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
        <div>
            <div class="py-4 px-2 flex justify-center">
                <a href="#" title="home">

                    <div class="flex flex-row items-center self-center gap-2">
                        <img src="/img/infotel.png" class="w-11 ml-[-10px]" />
                        <div class="flex flex-col">
                            <span class="text-base md:text-lg font-bold italic"> INFOTEL BUSINESS SAC</span>
                            <span class="text-sm md:text-base italic -mt-1"> Sistema INFOTELBUSINESS </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-center">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt=""
                        class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
                @else
                    <img class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28"
                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @endif
                <h5 class="mt-4 text-base md:text-xl font-semibold text-gray-600 ">{{ Auth::user()->name }}</h5>
                <span class="text-sm md:text-base text-gray-400">Administrador</span>
            </div>

            <ul class="space-y-2 tracking-wide mt-4 h-72 2xl:h-full overflow-y-auto pr-1">
                <x-sidebar-link href="{{ route('sistema-dashboard') }}" :active="request()->routeIs('sistema-dashboard')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-chart-simple"></i>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-categorias') }}" :active="request()->routeIs('sistema-categorias')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-tags"></i>
                    </x-slot>
                    {{ __('Categorias') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-productos') }}" :active="request()->routeIs('sistema-productos')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                    </x-slot>
                    {{ __('Productos') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-banners') }}" :active="request()->routeIs('sistema-banners')">
                    <x-slot name="logo">
                        <i class="fa-regular fa-images"></i>
                    </x-slot>
                    {{ __('Banners') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-videos') }}" :active="request()->routeIs('sistema-videos')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-video"></i>
                    </x-slot>
                    {{ __('Videos') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-categorias') }}" :active="request()->routeIs('mensajes')">
                    <x-slot name="logo">
                        <i class="fa-regular fa-envelope"></i>
                    </x-slot>
                    {{ __('Mensajes') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-usuarios') }}" :active="request()->routeIs('sistema-usuarios')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-users"></i>
                    </x-slot>
                    {{ __('Usuarios') }}
                </x-sidebar-link>
                <x-sidebar-link href="{{ route('sistema-perfil') }}" :active="request()->routeIs('profile.show', 'sistema-perfil')">
                    <x-slot name="logo">
                        <i class="fa-solid fa-user-gear"></i>
                    </x-slot>
                    {{ __('Perfil') }}
                </x-sidebar-link>
            </ul>
        </div>

        <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
            <ul class="w-full">
                <form method="POST" action="{{ route('cerrar-sesion') }}" x-data>
                    @csrf

                    <x-sidebar-link href="{{ route('cerrar-sesion') }}" @click.prevent="$root.submit();">
                        <x-slot name="logo">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </x-slot>
                        {{ __('Cerrar sesión') }}
                    </x-sidebar-link>
                </form>
            </ul>
        </div>
    </aside>
</div>

<div class="ml-auto lg:w-[75%] xl:w-[82%] 2xl:w-[85%]">
    <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
        <div class="lg:px-6 pl-0 pr-3 flex items-center justify-between space-x-4">
            <div hidden class="bg-grey-light w-48 rounded-md lg:block">
                <div class="flex items-center">
                    <a href="{{ route('sistema-dashboard') }}"
                        class="text-black transition duration-150 ease-in-out hover:text-gray-600"><i
                            class="fa-solid fa-house-chimney"></i></a>
                    <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                    <div class="text-neutral-500 dark:text-neutral-400 text-sm">
                        @if (request()->routeIs('sistema-dashboard'))
                            Dashboard
                        @elseif (request()->routeIs('sistema-productos'))
                            Productos
                        @elseif (request()->routeIs('sistema-categorias'))
                            Categorias
                        @elseif (request()->routeIs('sistema-banners'))
                            Banners
                        @elseif (request()->routeIs('sistema-videos'))
                            Videos
                        @elseif (request()->routeIs('sistema-mensajes'))
                            Mensajes
                        @elseif (request()->routeIs('sistema-usuarios'))
                            Usuarios
                        @elseif (request()->routeIs('profile.show', 'sistema-perfil'))
                            Configuracion de perfil
                        @endif
                    </div>
                </div>
            </div>
            <button @click="sidebarVisible = ! sidebarVisible"
                class="w-12 h-16 border-r lg:hidden focus:bg-white active:bg-gray-100 flex justify-center">
                <i class="fa-solid fa-bars fa-lg my-auto"></i>
            </button>
            <div class="flex space-x-3">
                <a href="{{ route('inicio') }}" target="_blank"
                    class="flex items-center justify-center w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <i class="fa-solid fa-globe"></i>
                </a>
                <button aria-label="notification"
                    class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <i class="fa-solid fa-bell"></i>
                </button>

                <div class="sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex">
                                    <button aria-label="user"
                                        class="h-10 px-3 py-2 inline-flex items-center rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                                        <i class="fa-solid fa-user"></i>
                                        <i class="fa-solid fa-chevron-down fa-xs ml-2 -mr-0.5"></i>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="px-4 py-2 bg-gray-100 -mt-1 rounded-t-md text-center">
                                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Administrar Cuenta') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('cerrar-sesion') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('cerrar-sesion') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Cerrar sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 bg-gray-100">
        {{ $content }}
    </div>
</div>

<script>
    // Obtiene la posición del scroll almacenada en el almacenamiento local
    const storedScrollPosition = localStorage.getItem("sidebarScrollPosition");

    // Si hay una posición almacenada, mueve el scroll a esa posición
    if (storedScrollPosition) {
        const sidebar = document.querySelector(".scroll-pos");
        sidebar.scrollTop = storedScrollPosition;
    }

    // Escucha el evento de desplazamiento y guarda la posición actual del scroll en el almacenamiento local
    const sidebar = document.querySelector(".scroll-pos");
    sidebar.addEventListener("scroll", function() {
        const scrollPosition = sidebar.scrollTop;
        localStorage.setItem("sidebarScrollPosition", scrollPosition);
    });
</script>
