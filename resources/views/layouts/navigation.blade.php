<nav class="bg-white shadow p-4 flex justify-between">

    <div>
        <span class="font-semibold">Makindye Pet Clinic System</span>
    </div>
<div class="flex gap-4 items-center">

    @php
        $user = auth()->user();
    @endphp

    <div class="text-right leading-tight">
        <div class="text-gray-700 font-medium">
            {{ $user->name ?? 'Guest' }}
        </div>

        @if($user)
            <div class="text-xs text-emerald-600 font-semibold">
                {{ $user->getRoleNames()->first() ?? 'No Role' }}
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit"
            class="text-red-600 hover:text-red-800 font-medium">
            Logout
        </button>
    </form>

</div>

</nav>
