<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
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
                        {{-- <li><a href="{{ route('positions.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Positions</a></li> --}}
                        {{-- <li><a href="{{ route('contract_types.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Contract Types</a></li> --}}
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
                        <h1 class="text-lg font-semibold">Departments</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <img src="{{ Auth::user()->profile_picture }}" alt="Profile Photo" class="w-10 h-10 rounded-full">
                    
                        <div>
                            <button id="dropdownButton" class="focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 0 24 0 24" xmlns="http://www.w3.org/2000/svg">
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

            <!-- Departments Content -->
            <main class="p-6 bg-gray-100 min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Departments</h2>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-4">Add Department</a>
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/3 px-4 py-2">ID</th>
                                <th class="w-1/3 px-4 py-2">Name</th>
                                <th class="w-1/3 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td class="border px-4 py-2">{{ $department->id }}</td>
                                    <td class="border px-4 py-2">{{ $department->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info">Show</a>
                                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
