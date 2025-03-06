<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Top Bar -->
            @include('components.topbar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow p-4 flex justify-between items-center">
                    <h1 class="text-lg font-semibold">Request Leave</h1>
                </header>

                <main class="p-6 bg-gray-100 min-h-screen">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-4">Leave Request Form</h2>
                        @if (session('success'))
                            <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('leaves.store') }}" method="POST">
                            @csrf
                            
                            <!-- Employee Name -->
                            <div class="mb-4">
                                <label for="employee_name" class="block text-sm font-medium text-gray-700">Employee Name</label>
                                <input type="text" name="employee_name" id="employee_name" value="{{ auth()->user()->name }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                            </div>

                            <!-- Start Date -->
                            <div class="mb-4">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" min="{{ now()->addWeek()->toDateString() }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <!-- End Date -->
                            <div class="mb-4">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" id="end_date" min="{{ now()->addDay(8)->toDateString() }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <!-- Type of Leave -->
                            <div class="mb-4">
                                <label for="type" class="block text-sm font-medium text-gray-700">Type of Leave</label>
                                <select name="type" id="type" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="annual">Annual Leave</option>
                                    <option value="sick">Sick Leave</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6">
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                                    Submit Leave Request
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
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
