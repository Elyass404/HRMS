<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Position</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white h-screen">
            <div class="p-4">
                <h2 class="text-xl font-bold">Navigation</h2>
                <nav class="mt-4">
                    <ul>
                        <li><a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
                        <li><a href="{{ route('departments.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Departments</a></li>
                        <li><a href="{{ route('users.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Employees</a></li>
                        <li><a href="{{ route('positions.index') }}" class="block py-2 px-4 bg-gray-700 hover:bg-gray-600">Manage Positions</a></li>
                        <li><a href="{{ route('contract-types.index') }}" class="block py-2 px-4 bg-gray-700 hover:bg-gray-600">Manage Contract Types</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-4 py-2">
                    <div>
                        <h1 class="text-lg font-semibold">Create Contract Type</h1>
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

            <!-- Create Contract Type Content -->
            <main class="p-6 bg-gray-100 min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Add New Contract Type</h2>
                    <form action="{{ route('contract-types.store') }}" method="POST">
                        @csrf
                        <!-- Position Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Contract Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-md">Create Position</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        document.getElementById('dropdownButton').addEventListener('click', function () {
            var dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
                dropdownMenu.classList.add('block');
            } else {
                dropdownMenu.classList.remove('block');
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
