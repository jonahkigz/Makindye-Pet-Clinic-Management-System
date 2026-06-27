<div class="space-y-6">

    {{-- Hero --}}
    <div class="rounded-2xl bg-gradient-to-r from-emerald-700 to-green-500 p-8 text-white shadow-lg">
        <h1 class="text-3xl font-bold">
            Administrator Dashboard
        </h1>

        <p class="mt-2 text-green-100">
            Welcome to the Makindye Pet Clinic Management System.
        </p>
    </div>

    {{-- Statistics --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-gray-500">Today's Appointments</p>
            <h2 class="mt-2 text-3xl font-bold text-emerald-700">{{ $stats['today_appointments'] }}</h2>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-gray-500">Registered Pets</p>
            <h2 class="mt-2 text-3xl font-bold text-emerald-700">{{ $stats['registered_pets'] }}</h2>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-gray-500">Pet Owners</p>
            <h2 class="mt-2 text-3xl font-bold text-emerald-700">{{ $stats['pet_owners'] }}</h2>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <p class="text-gray-500">Monthly Revenue</p>
            <h2 class="mt-2 text-3xl font-bold text-emerald-700">UGX {{ number_format($stats['monthly_revenue']) }}</h2>
        </div>

    </div>

    {{-- Two Column Layout --}}
    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Recent Activity --}}
        <div class="lg:col-span-2 rounded-xl bg-white p-6 shadow">

            <h2 class="mb-4 text-xl font-semibold">
                Recent Activity
            </h2>

            <div class="rounded-lg border border-dashed border-gray-300 p-10 text-center text-gray-500">
                Recent appointments and activities will appear here.
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="rounded-xl bg-white p-6 shadow">

            <h2 class="mb-4 text-xl font-semibold">
                Quick Actions
            </h2>

            <div class="space-y-3">

                <button class="w-full rounded-lg bg-emerald-600 py-3 text-white hover:bg-emerald-700">
                    Register Pet
                </button>

                <button class="w-full rounded-lg bg-green-600 py-3 text-white hover:bg-green-700">
                    Book Appointment
                </button>

                <button href="{{ route('owners.index') }}" class="w-full rounded-lg bg-lime-600 py-3 text-white hover:bg-lime-700">
                    Add Pet Owner
                </button>

                <button class="w-full rounded-lg bg-teal-600 py-3 text-white hover:bg-teal-700">
                    View Reports
                </button>

            </div>

        </div>

    </div>

</div>