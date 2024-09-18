<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('users.create') }}" class="underline">Add new user</a>
                    @if (session('status') === 'User created successfully.')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('User created successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'User updated successfully.')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('User updated successfully.') }}
                        </p>
                    @endif
                    @if (session('status') === 'User deleted successfully.')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('User deleted successfully.') }}
                        </p>
                    @endif
                    <table class="w-full table-auto border-collapse border-gray-200 mt-4">
                        <thead>
                            <tr>
                                <th class="border border-gray-200 px-4 py-2">First Name</th>
                                <th class="border border-gray-200 px-4 py-2">Last Name</th>
                                <th class="border border-gray-200 px-4 py-2">Email</th>
                                <th class="border border-gray-200 px-4 py-2">Registered at</th>
                                <th class="border border-gray-200 px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->first_name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->last_name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $user->created_at }}</td>
                                    <td class="border border-gray-200 px-4 py-2">
                                        <a href=" {{ route('users.edit', $user) }}">Edit</a>
                                        |
                                        <form method="POST" class="inline-block"
                                            action=" {{ route('users.destroy', $user) }}"
                                            onsubmit=" return confirm('Are you sure?')">
                                            @method('DELETE')
                                            @csrf
                                            <button class="text-red-500 underline" type="submit">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
