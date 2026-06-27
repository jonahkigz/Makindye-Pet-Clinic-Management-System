<nav class="bg-white shadow p-4 flex justify-between">

    <div>
        <span class="font-semibold">Makindye Pet Clinic System</span>
    </div>

    <div class="flex gap-4 items-center">

        <span class="text-gray-600">
            {{ auth()->user()->name ?? 'Guest' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="text-red-600 hover:underline">
        Logout
    </button>
</form>

    </div>

</nav>