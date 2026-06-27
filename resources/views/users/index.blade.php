@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500">Create, edit and delete MPCMS users.</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl shadow">
            + Add User
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-emerald-50 text-emerald-800">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Created</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('users.edit', $user) }}"
                               class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection