hey still in progress





<!-- Logout Form -->
<div class="mt-4">
    @guest
        <a href="{{ route('login') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            {{ __('Log In') }}
        </a>
    @else
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                {{ __('Log Out') }}
            </a>
        </form>
    @endguest
</div>
