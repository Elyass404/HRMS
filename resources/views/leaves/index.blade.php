<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
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
                    <h2 class="text-2xl font-bold mb-4">Leave Requests</h2>

                    @if(Auth::user()->admin)
                    <p>this is an admin</p>
                    @endif

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-left">Employee Name</th>
                                <th class="px-4 py-2 border-b text-left">Start Date</th>
                                <th class="px-4 py-2 border-b text-left">End Date</th>
                                <th class="px-4 py-2 border-b text-left">Type</th>
                                <th class="px-4 py-2 border-b text-left">Status</th>
                                <th class="px-4 py-2 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leaves as $leave)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $leave->employee->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $leave->start_date }}</td>
                                    <td class="px-4 py-2 border-b">{{ $leave->end_date }}</td>
                                    <td class="px-4 py-2 border-b">{{ ucfirst($leave->type) }}</td>
                                    <td class="px-4 py-2 border-b">{{ ucfirst($leave->status) }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <!-- Actions for Managers/HR -->
                                        <a href="{{ route('leaves.edit', $leave->id) }}" 
                                           class="text-blue-600 hover:text-blue-800">Edit</a> |
                                           <form action="{{ route('leaves.destroy', $leave) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No leave requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
