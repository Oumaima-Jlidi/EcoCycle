<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('login') ? 'font-bold' : '' }}">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('register') ? 'font-bold' : '' }}">
                    {{ __('Register') }}
                </a>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ __('Log Out') }}
                    </a>
                </form>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? '' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Additional authenticated user settings can go here -->
            </div>
        </div>
    </div>
</nav>
