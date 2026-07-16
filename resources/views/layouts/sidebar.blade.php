@php
    $role = auth()->user()->role ?? 'Pet Owner';
@endphp
<aside class="w-72 min-h-screen m-4 rounded-3xl bg-[#0F766E] text-white shadow-2xl overflow-hidden">
<div class="px-6 py-8 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-2xl shadow-lg">
                🐾
            </div>

            <div>
                <h1 class="text-xl font-bold tracking-wide">
                    MPCMS
                </h1>
                <p class="text-xl text-green-950">
                    Makindye Pet Clinic
                </p>
            </div>
        </div>
    </div>

<nav class="mt-6 px-4 pb-6 space-y-2">

    {{-- DASHBOARD (ALL ROLES) --}}
    <a href="{{ route('dashboard') }}"
       class="group flex items-center px-4 py-3 rounded-xl  hover:bg-emerald-400 transition-all duration-300">
        <span class="text-xl">🏠</span>
        <span class="ml-4 font-medium">Dashboard</span>
    </a>

    {{-- ================= ADMIN ONLY ================= --}}
    @if($role === 'Administrator')

        <a href="{{ route('users.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👥</span>
            <span class="ml-4 font-semibold">User Management</span>
        </a>
    <a href="{{ route('owners.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👨‍👩‍👧</span>
            <span class="ml-4 font-semibold">Pet Owners</span>
        </a>
     <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4 font-semibold">Pets</span>
        </a>
     <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4 font-semibold">Appointments</span>
        </a>
    <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🩺</span>
            <span class="ml-4 font-semibold">Medical Reports</span>
        </a>

        <a href="{{ route('reports.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📊</span>
            <span class="ml-4 font-semibold">Clinic Reports</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💊</span>
            <span class="ml-4 font-semibold">Products</span>
        </a>

        <a href="{{ route('payments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💳</span>
            <span class="ml-4 font-semibold">Payments</span>
        </a>

        <a href="{{ route('invoices.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4 font-semibold">Invoices</span>
        </a>

        <a href="{{ route('services.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🛠</span>
            <span class="ml-4 font-semibold">Services</span>
        </a>

    @endif

    {{-- ================= VETERINARIAN ================= --}}
    @if($role === 'Veterinarian')

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4 font-semibold">My Appointments</span>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🩺</span>
            <span class="ml-4 font-semibold">Medical Reports</span>
        </a>

        <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4 font-semibold">Pets</span>
        </a>

    @endif

    {{-- ================= RECEPTIONIST ================= --}}
    @if($role === 'Receptionist')

        <a href="{{ route('owners.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👨‍👩‍👧</span>
            <span class="ml-4 font-semibold">Pet Owners</span>
        </a>

        <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4 font-semibold">Pets</span>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4 font-semibold">Appointments</span>
        </a>
        <a href="{{ route('payments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💳</span>
            <span class="ml-4 font-semibold">Payments</span>
        </a>
        <a href="{{ route('invoices.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4 font-semibold">Invoices</span>
        </a>

    @endif

    {{-- ================= PET OWNER ================= --}}
    @if($role === 'Pet Owner')

        <a href="{{ route('pets.create') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">➕</span>
            <span class="ml-4 font-semibold">Add Pet</span>
        </a>

        <a href="{{ route('appointments.create') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4 font-semibold">Book Appointment</span>
        </a>

        <a href="{{ route('owner.invoices') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4 font-semibold">My Invoices</span>
        </a>

    @endif

    {{-- PROFILE (ALL ROLES) --}}
    <div class="mt-auto border-t border-white/10 pt-4">

    <a href="{{ route('profile.show') }}"
       class="flex items-center gap-3 rounded-xl p-3 transition hover:bg-white/10">

        @if(auth()->user()->profile_photo_path)
            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                 alt="{{ auth()->user()->name }}"
                 class="h-11 w-11 rounded-full border-2 border-white/30 object-cover">
        @else
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-white/20 font-bold text-white">
                {{ auth()->user()->initials }}
            </div>
        @endif

        <div class="min-w-0 flex-1">
            <p class="truncate font-semibold text-white">
                {{ auth()->user()->name }}
            </p>

            <p class="truncate text-xs text-emerald-100">
                {{ auth()->user()->role }}
            </p>
        </div>

        <svg class="h-5 w-5 text-emerald-100"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>
    </a>

</div>

    {{-- LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}" class="pt-2">
        @csrf
        <button type="submit"
                class="w-full group flex items-center px-4 py-3 rounded-xl hover:bg-orange-500 hover:translate-x-2 transition-all duration-300 text-left">
            <span class="text-xl">🚪</span>
            <span class="ml-4 font-semibold">Logout</span>
        </button>
    </form>

</nav>
</aside>
