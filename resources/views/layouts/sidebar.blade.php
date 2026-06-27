<aside class="w-72 bg-gradient-to-b from-emerald-950 via-green-900 to-teal-950 text-gray-100 min-h-screen shadow-2xl">

    {{-- Logo --}}
    <div class="px-6 py-8 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-2xl shadow-lg">
                🐾
            </div>

            <div>
                <h2 class="text-xl font-bold tracking-wide">
                    MPCMS
                </h2>
                <p class="text-xs text-green-300">
                    Makindye Pet Clinic
                </p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="mt-6 px-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="group flex items-center px-4 py-3 rounded-xl bg-emerald-500 text-white shadow-lg hover:bg-emerald-400 transition-all duration-300">
            <span class="text-xl">🏠</span>
            <span class="ml-4 font-medium">Dashboard</span>
        </a>

        <a href="{{ route('users.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👥</span>
            <span class="ml-4">User Management</span>
        </a>

        <a href="{{ route('owners.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">👨‍👩‍👧</span>
            <span class="ml-4">Pet Owners</span>
        </a>

        <a href="{{ route('pets.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🐾</span>
            <span class="ml-4">Pets</span>
        </a>

        <a href="{{ route('appointments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📅</span>
            <span class="ml-4">Appointments</span>
        </a>

        <a href="{{ route('medical-records.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🩺</span>
            <span class="ml-4">Medical Records</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💊</span>
            <span class="ml-4">Products</span>
        </a>

        <a href="{{ route('services.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🛠</span>
            <span class="ml-4">Services</span>
        </a>

        <a href="{{ route('invoices.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">🧾</span>
            <span class="ml-4">Invoices</span>
        </a>

        <a href="{{ route('payments.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">💳</span>
            <span class="ml-4">Payments</span>
        </a>

        <a href="{{ route('reports.index') }}"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">📊</span>
            <span class="ml-4">Clinic Reports</span>
        </a>

        <a href="#"
           class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300">
            <span class="text-xl">⚙️</span>
            <span class="ml-4">Profile</span>
        </a>

        {{-- Logout - Now same style as other items --}}
        <form method="POST" action="{{ route('logout') }}" class="pt-2">
            @csrf
            <button
                type="submit"
                class="w-full group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 hover:translate-x-2 transition-all duration-300 text-left">
                <span class="text-xl">🚪</span>
                <span class="ml-4 font-semibold">Logout</span>
            </button>
        </form>

    </nav>

</aside>