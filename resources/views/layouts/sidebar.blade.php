<aside class="w-64 bg-gray-800 text-white h-screen">
    <div class="p-4">
        <h2 class="text-xl font-bold">Navigation</h2>
        <nav class="mt-4">
            <ul>
                <li><a href="{{ route('dashboard') }}" class="block py-2 hover:bg-gray-700">Dashboard</a></li>
                @can('manage users')
                <li><a href="{{ route('roles.index') }}" class="block py-2 hover:bg-gray-700">Manage Roles</a></li>
                <li><a href="{{ route('permissions.index') }}" class="block py-2 hover:bg-gray-700">Manage Permissions</a></li>
                @endcan
                @can('manage employees')
                <li><a href="{{ route('employees.index') }}" class="block py-2 hover:bg-gray-700">Manage Employees</a></li>
                @endcan
                @can('manage departments')
                <li><a href="{{ route('departments.index') }}" class="block py-2 hover:bg-gray-700">Manage Departments</a></li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
