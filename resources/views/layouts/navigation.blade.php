<nav class="bg-white shadow p-4 flex justify-between">

    <div>
        <span class="font-semibold">Makindye Pet Clinic System</span>
    </div>
@php
    $user = auth()->user();
    $role = $user?->getRoleNames()->first();
@endphp

<div class="flex gap-4 items-center">

    <div class="text-gray-700 font-medium">
    👤 {{ $user->name ?? 'Guest' }}

    <p class="text-red-600 font-bold">TEST ROLE AREA</p>
</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-600 hover:underline">
            Logout
        </button>
    </form>

</div>

</nav>
