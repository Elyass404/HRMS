<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Leave Request</title>
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
            <main class="p-6 bg-gray-100 min-h-screen">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Edit Leave Request</h2>

                    <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Employee Name -->
                        <div class="mb-4">
                            <label for="employee_name" class="block text-sm font-medium text-gray-700">Employee Name</label>
                            <input type="text" id="employee_name" value="{{ $leave->employee->name }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                        </div>

                        <!-- Leave Details -->
                        <div class="mb-4">
                            <label for="dates" class="block text-sm font-medium text-gray-700">Leave Dates</label>
                            <input type="text" id="dates" 
                                   value="{{ $leave->start_date }} to {{ $leave->end_date }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                        </div>

                        <!-- Type of Leave -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input type="text" id="type" value="{{ ucfirst($leave->type) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                        </div>

                        <!-- Status -->
                        <!-- Manager Approval -->
@if (auth()->user()->hasRole('Manager|Admin'))
<div class="mb-4">
    <label for="manager_approval" class="block text-sm font-medium text-gray-700">Manager Approval</label>
    <select name="manager_approval" id="manager_approval" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="pending" {{ $leave->manager_approval === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $leave->manager_approval === 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $leave->manager_approval === 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</div>
@endif

<!-- HR Approval -->
@if (auth()->user()->hasRole('HR|Admin'))
<div class="mb-4">
    <label for="hr_approval" class="block text-sm font-medium text-gray-700">HR Approval</label>
    <select name="hr_approval" id="hr_approval" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="pending" {{ $leave->hr_approval === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $leave->hr_approval === 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $leave->hr_approval === 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</div>
@endif

                        <!-- Save Button -->
                        <div class="mt-6">
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                                Update Leave Request
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
