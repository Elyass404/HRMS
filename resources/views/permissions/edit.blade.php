<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Position</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        
            @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            @include('components.topbar')

            <!-- Edit Position Content -->
            <main class="p-6 bg-gray-100 min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Edit Position</h2>
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Contract Type Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                            <input type="text" name="name" id="name" value="{{ $permission->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded-md">Update Permission</button>
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
