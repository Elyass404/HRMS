<!-- Top Bar -->
<header class="bg-blue shadow">
    <div class="flex justify-between items-center px-4 py-2">
        <div>
            <h1 class="text-lg font-semibold">Welcome Back {{Auth::user()->name}}</h1>
        </div>
        <div class="flex items-center space-x-4">
            <img src="{{ Auth::user()->profile_picture }}" alt="Profile Photo" class="w-10 h-10 rounded-full">
            <div>
                <button id="dropdownButton" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 6h14M5 18h14"></path>
                    </svg>
                </button>
                <div id="dropdownMenu" class="hidden bg-white shadow-md rounded-lg py-2 mt-2">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700">Manage Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>