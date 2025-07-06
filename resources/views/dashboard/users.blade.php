@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Users</h1>
        @include('components.modals.create-user')
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Country</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Gender</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->country }}</td>
                        <td class="px-6 py-4">{{ $user->gender }}</td>
                        <td class="px-6 py-4 space-x-2 flex flex-row">
                            @include('components.modals.view-user', ['user' => $user])
                            @include('components.modals.edit-user', ['user' => $user])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
