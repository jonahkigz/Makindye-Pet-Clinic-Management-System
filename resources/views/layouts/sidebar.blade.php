@php
    $role = auth()->user()->role ?? 'Pet Owner';
@endphp
<aside>
<div class="px-6 py-8 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-2xl shadow-lg">
                🐾
            </div>

            <div>
                <h1 class="text-xl font-bold tracking-wide">
                    MPCMS
                </h1>
                <p class="text-xl text-green-900">
                    Makindye Pet Clinic
                </p>
            </div>
        </div>
    </div>

<nav class="mt-6 px-4 space-y-2">

    {{-- DASHBOARD (ALL ROLES) --}}
    <a href="{{ route('dashboard') }}"
       class="group flex items-center px-4 py-3 rounded-xl text-white  hover:bg-emerald-400 transition-all duration-300">
        <span class="text-xl">🏠</span>
        <span class="ml-4 font-medium">Dashboard</span>
    </a>

    {{-- ================= ADMIN ONLY ================= --}}
    @if($role === 'Administrator')

        <a href="{{ route('users.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👥</span>
            <span class="ml-4">User Management</span>
        </a>
    <a href="{{ route('owners.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👨‍👩‍👧</span>
            <span class="ml-4">Pet Owners</span>
        </a>
     <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4">Pets</span>
        </a>

        <a href="{{ route('reports.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📊</span>
            <span class="ml-4">Clinic Reports</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💊</span>
            <span class="ml-4">Products</span>
        </a>

        <a href="{{ route('payments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💳</span>
            <span class="ml-4">Payments</span>
        </a>

        <a href="{{ route('invoices.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4">Invoices</span>
        </a>

        <a href="{{ route('services.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🛠</span>
            <span class="ml-4">Services</span>
        </a>

    @endif

    {{-- ================= VETERINARIAN ================= --}}
    @if($role === 'Veterinarian')

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4">My Appointments</span>
        </a>

        <a href="{{ route('medical-records.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🩺</span>
            <span class="ml-4">Medical Records</span>
        </a>

        <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4">Pets</span>
        </a>

    @endif

    {{-- ================= RECEPTIONIST ================= --}}
    @if($role === 'Receptionist')

        <a href="{{ route('owners.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👨‍👩‍👧</span>
            <span class="ml-4">Pet Owners</span>
        </a>

        <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4">Pets</span>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4">Appointments</span>
        </a>

        <a href="{{ route('invoices.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4">Invoices</span>
        </a>

    @endif

    {{-- ================= PET OWNER ================= --}}
    @if($role === 'Pet Owner')

        <a href="{{ route('pets.create') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">➕</span>
            <span class="ml-4">Add Pet</span>
        </a>

        <a href="{{ route('appointments.create') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4">Book Appointment</span>
        </a>

        <a href="#"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🩺</span>
            <span class="ml-4">My Medical Records</span>
        </a>

    @endif

    {{-- PROFILE (ALL ROLES) --}}
    <a href="#"
       class="group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300">
        <span class="text-xl">⚙️</span>
        <span class="ml-4">Profile</span>
    </a>

    {{-- LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}" class="pt-2">
        @csrf
        <button type="submit"
                class="w-full group flex items-center px-4 py-3 rounded-xl hover:bg-emerald-400 hover:translate-x-2 transition-all duration-300 text-left">
            <span class="text-xl">🚪</span>
            <span class="ml-4 font-semibold">Logout</span>
        </button>
    </form>

</nav>
</aside>
