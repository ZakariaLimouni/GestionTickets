
<nav x-data="{ open: false }" class="bg-white dark:bg-white-800 border-b border-white-100 dark:border-white-700">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                <img src="{{ asset('img/img.jpeg') }}" alt=""class="block h-9 w-auto fill-current text-grey-800 dark:text-grey-200" />
                    
                </div>
                <!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    @if(auth()->check())
        @php
            /** @var \App\Models\User $user */
            $user = auth()->user();
        @endphp
        @if($user->hasRole('admin|mini-admin'))


        <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown  width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white-500 dark:text-white-400 bg-white dark:bg-white-800 hover:text-white-700 dark:hover:text-white-300 focus:outline-none transition ease-in-out duration-150">
                            <div style="color:grey">{{ __('Gestion utilisateurs') }}</div>

                            <div class="ms-1" style="color: grey">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.createUser')">
                            {{ __('Créer Utilisateur') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.gestionUser')" >
                            {{ __('Afficher Utilisateurs') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>



        <x-nav-link :href="route('admin.gestionVille')" style="position: relative;">
            <span>{{ __('Gestion Ville') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('admin.gestionAgence')" style="position: relative;">
            <span>{{ __('Gestion Agence') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('admin.gestionPermission')" style="position: relative;">
            <span>{{ __('Permissions') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('admin.gestionRole')" style="position: relative;">
            <span>{{ __('Roles') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('admin.gestionTypeTicket')" style="position: relative;">
            <span>{{ __('Type Ticket') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('admin.gestionTypeDocument')" style="position: relative;">
            <span>{{ __('Type Document') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        @elseif(auth()->user()->status === 'active')
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="position: relative;">
            <span>{{ __('') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('user.gestionTicket')" style="position: relative;">
            <span>{{ __('Gestion des Tickets') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        <x-nav-link :href="route('user.createTicket')" style="position: relative;">
            <span>{{ __('Creer un Ticket') }}</span>
            <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-500 transition-all transform scale-x-0"></span>
        </x-nav-link>
        @endif
    @endif
</div>
 
           </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white-500 dark:text-white-400 bg-white dark:bg-white-800 hover:text-white-700 dark:hover:text-white-300 focus:outline-none transition ease-in-out duration-150">
                            <div style="color: green">{{ Auth::user()->name }}</div>

                            <div class="ms-1" style="color: green">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Votre Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white-400 dark:text-white-500 hover:text-white-500 dark:hover:text-white-400 hover:bg-white-100 dark:hover:bg-white-900 focus:outline-none focus:bg-white-100 dark:focus:bg-white-900 focus:text-white-500 dark:focus:text-white-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white-200 dark:border-white-600">
            <div class="px-4">
                <div class="font-medium text-base text-white-800 dark:text-white-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 white">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
