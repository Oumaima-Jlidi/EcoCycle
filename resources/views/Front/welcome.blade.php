hey still in progress





   <!-- Logout Form -->
   <div class="mt-4">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); this.closest('form').submit();"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            {{ __('Log Out') }}
        </a>
    </form>
</div>