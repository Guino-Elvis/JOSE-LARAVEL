<!--Contacto y redes-->
<div
    class="lg:flex md:flex md:justify-between items-center lg:justify-between bg-gray-200 text-[0.75rem] md:text-[0.875rem] px-8 py-1 sm:flex-none">
    <div class="">
        <x-responsive-nav-link href="{{ route('inicio') }}" :active="request()->routeIs('inicio', 'inicio')">
            {{ __('Inicio') }}
        </x-responsive-nav-link>
    </div>
    @auth
    <div class="">
        <x-responsive-nav-link href="{{ route('inicio') }}" :active="request()->routeIs('inicio', 'inicio')">
            {{ __('Inicio2') }}
        </x-responsive-nav-link>
    </div>
    @endauth


    <div class="flex gap-3 justify-center items-center">
        @auth
            <div class="sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex">
                                <button aria-label="user"
                                    class="px-3 py-1 flex items-center gap-2 rounded-lg border border border-black active:bg-zinc-700 active:text-white">
                                    <i class="fa-solid fa-user"></i>
                                    {{ Auth::user()->name }}
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

                            <x-dropdown-link href="{{ route('profile.show') }}" target="_blank">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        @else
            <a href="/login-infotelbusiness"
                class="px-3 py-1 flex items-center gap-2 rounded-lg border border-black active:bg-zinc-700 active:text-white">
                <i class="fa-solid fa-user"></i>
                Iniciar sesión
            </a>
        @endauth
    </div>
</div>
