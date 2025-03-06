<!-- Sidebar -->
<aside class="w-64 bg-gray-800 text-white h-screen">
    <div class="p-4">
        <h2 class="text-xl font-bold">Navigation</h2>
        <nav class="mt-4">
            <ul>
                @hasrole('Admin|HR')
                <li><a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
                <li><a href="{{ route('departments.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Departments</a></li>
                @endhasrole
                @hasrole('Admin|HR|Manager')
                <li><a href="{{ route('users.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Employees</a></li>
                @endhasrole
                @hasrole('Admin|HR')
                <li><a href="{{ route('positions.index') }}" class="block py-2 px-4 hover:bg-gray-600">Manage Positions</a></li>
                <li><a href="{{ route('contract-types.index') }}" class="block py-2 px-4 hover:bg-gray-600">Manage Contract Types</a></li>
                @endhasrole
                @hasrole('Admin')
                <li><a href="{{ route('roles.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Roles</a></li>
                <li><a href="{{ route('permissions.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Permissions</a></li>
                @endhasrole
                       
            </ul>
        </nav>
    </div>
</aside>