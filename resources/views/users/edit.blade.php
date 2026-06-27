@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit User</h1>

    <div class="bg-white rounded-2xl shadow p-8 border">
        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-5">
            @csrf
            @method('PUT')

            @include('users.form')

            <div class="flex justify-between pt-4">
                <a href="{{ route('users.index') }}" class="px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200">
                    Cancel
                </a>

                <button class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white">
                    Update User
                </button>
            </div>
        </form>
    </div>

</div>
@endsection