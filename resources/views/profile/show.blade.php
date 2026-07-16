@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- ============================================
        PAGE HEADER
    ============================================= --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-800 via-emerald-700 to-green-500 p-6 md:p-8 text-white shadow-lg">

        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-20 right-24 h-44 w-44 rounded-full bg-white/10"></div>

        <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div>
                <p class="mb-2 text-sm font-medium uppercase tracking-wider text-emerald-100">
                    Account settings
                </p>

                <h1 class="text-3xl font-bold">
                    My Profile
                </h1>

                <p class="mt-2 max-w-2xl text-emerald-100">
                    Manage your personal information, profile picture and account security.
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 font-semibold text-emerald-700 shadow transition hover:bg-emerald-50">

                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>

                Back to Dashboard
            </a>

        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 shadow-sm">

            <svg class="mt-0.5 h-6 w-6 flex-shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            <div>
                <p class="font-semibold">Success</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('password_success'))
        <div class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800 shadow-sm">

            <svg class="mt-0.5 h-6 w-6 flex-shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            <div>
                <p class="font-semibold">Password updated</p>
                <p class="text-sm">{{ session('password_success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- ============================================
            PROFILE SUMMARY
        ============================================= --}}
        <div class="space-y-6">

            <div class="overflow-hidden rounded-3xl bg-white shadow">

                <div class="h-28 bg-gradient-to-r from-emerald-700 to-green-500"></div>

                <div class="px-6 pb-6">

                    <div class="-mt-16 flex justify-center">

                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                 alt="{{ $user->name }}"
                                 class="h-32 w-32 rounded-full border-4 border-white object-cover shadow-lg">
                        @else
                            <div class="flex h-32 w-32 items-center justify-center rounded-full border-4 border-white bg-emerald-100 text-4xl font-bold text-emerald-700 shadow-lg">
                                {{ $user->initials }}
                            </div>
                        @endif

                    </div>

                    <div class="mt-4 text-center">
                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ $user->email }}
                        </p>

                        <span class="mt-3 inline-flex rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-semibold text-emerald-700">
                            {{ $user->role ?? 'User' }}
                        </span>
                    </div>

                    <div class="mt-6 space-y-4 border-t border-gray-100 pt-6">

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500">Phone</span>
                            <span class="text-right text-sm font-medium text-gray-800">
                                {{ $user->phone ?: 'Not provided' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500">Account created</span>
                            <span class="text-right text-sm font-medium text-gray-800">
                                {{ $user->created_at?->format('d M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm text-gray-500">Last updated</span>
                            <span class="text-right text-sm font-medium text-gray-800">
                                {{ $user->updated_at?->diffForHumans() }}
                            </span>
                        </div>

                    </div>

                    @if($user->profile_photo_path)
                        <form method="POST"
                              action="{{ route('profile.photo.remove') }}"
                              class="mt-6"
                              onsubmit="return confirm('Remove your profile picture?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="w-full rounded-xl border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                                Remove Profile Picture
                            </button>
                        </form>
                    @endif

                </div>
            </div>

            {{-- SECURITY NOTICE --}}
            <div class="rounded-3xl border border-blue-100 bg-blue-50 p-6 shadow-sm">
                <div class="flex gap-3">

                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                        <svg class="h-6 w-6"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 11c0-1.105.895-2 2-2s2 .895 2 2v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2c0-1.105.895-2 2-2m2-4a4 4 0 00-4 4v1h8V9a4 4 0 00-4-4z"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-semibold text-blue-900">
                            Account Security
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-blue-700">
                            Use a unique password containing uppercase letters,
                            lowercase letters and numbers.
                        </p>
                    </div>

                </div>
            </div>

        </div>

        {{-- ============================================
            PROFILE AND PASSWORD FORMS
        ============================================= --}}
        <div class="space-y-6 xl:col-span-2">

            {{-- PERSONAL INFORMATION --}}
            <div class="rounded-3xl bg-white p-6 shadow md:p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">
                        Personal Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Update the information associated with your MPCMS account.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data"
                      class="space-y-6">

                    @csrf
                    @method('PUT')

                    <div>
                        <label for="profile_photo"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Profile Picture
                        </label>

                        <input type="file"
                               name="profile_photo"
                               id="profile_photo"
                               accept=".jpg,.jpeg,.png,.webp"
                               class="block w-full rounded-xl border border-gray-300 bg-white text-sm text-gray-700
                                      file:mr-4 file:border-0 file:bg-emerald-50 file:px-4 file:py-3
                                      file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">

                        <p class="mt-2 text-xs text-gray-500">
                            JPG, PNG or WEBP. Maximum file size: 2 MB.
                        </p>

                        @error('profile_photo')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">

                        <div>
                            <label for="name"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm
                                          focus:border-emerald-500 focus:ring-emerald-500">

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="email"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm
                                          focus:border-emerald-500 focus:ring-emerald-500">

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Phone Number
                            </label>

                            <input type="text"
                                   name="phone"
                                   id="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+256 700 000000"
                                   class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm
                                          focus:border-emerald-500 focus:ring-emerald-500">

                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="role"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                System Role
                            </label>

                            <input type="text"
                                   id="role"
                                   value="{{ $user->role ?? 'User' }}"
                                   disabled
                                   class="w-full cursor-not-allowed rounded-xl border-gray-200 bg-gray-100 px-4 py-3 text-gray-500">

                            <p class="mt-1 text-xs text-gray-500">
                                Only an administrator can change system roles.
                            </p>
                        </div>

                    </div>

                    <div>
                        <label for="address"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Address
                        </label>

                        <textarea name="address"
                                  id="address"
                                  rows="3"
                                  placeholder="Enter your physical address"
                                  class="w-full rounded-xl border-gray-300 px-4 py-3 shadow-sm
                                         focus:border-emerald-500 focus:ring-emerald-500">{{ old('address', $user->address) }}</textarea>

                        @error('address')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex justify-end border-t border-gray-100 pt-6">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-700 px-6 py-3 font-semibold text-white shadow transition hover:bg-emerald-800">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                            Save Profile Changes
                        </button>
                    </div>

                </form>
            </div>

            {{-- CHANGE PASSWORD --}}
            <div class="rounded-3xl bg-white p-6 shadow md:p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">
                        Change Password
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Confirm your current password before setting a new one.
                    </p>
                </div>

                @if($errors->updatePassword->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                        <p class="font-semibold text-red-800">
                            Password could not be updated
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">
                            @foreach($errors->updatePassword->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('profile.password.update') }}"
                      class="space-y-5">

                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password"
                               class="mb-2 block text-sm font-semibold text-gray-700">
                            Current Password
                        </label>

                        <div class="relative">
                            <input type="password"
                                   name="current_password"
                                   id="current_password"
                                   required
                                   autocomplete="current-password"
                                   class="w-full rounded-xl border-gray-300 px-4 py-3 pr-12 shadow-sm
                                          focus:border-emerald-500 focus:ring-emerald-500">

                            <button type="button"
                                    onclick="togglePassword('current_password', this)"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-emerald-700">
                                Show
                            </button>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">

                        <div>
                            <label for="password"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                New Password
                            </label>

                            <div class="relative">
                                <input type="password"
                                       name="password"
                                       id="password"
                                       required
                                       autocomplete="new-password"
                                       class="w-full rounded-xl border-gray-300 px-4 py-3 pr-12 shadow-sm
                                              focus:border-emerald-500 focus:ring-emerald-500">

                                <button type="button"
                                        onclick="togglePassword('password', this)"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-emerald-700">
                                    Show
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Confirm New Password
                            </label>

                            <div class="relative">
                                <input type="password"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       required
                                       autocomplete="new-password"
                                       class="w-full rounded-xl border-gray-300 px-4 py-3 pr-12 shadow-sm
                                              focus:border-emerald-500 focus:ring-emerald-500">

                                <button type="button"
                                        onclick="togglePassword('password_confirmation', this)"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-emerald-700">
                                    Show
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="rounded-xl bg-amber-50 p-4 text-sm text-amber-800">
                        Your new password must contain at least eight characters,
                        including uppercase letters, lowercase letters and numbers.
                    </div>

                    <div class="flex justify-end border-t border-gray-100 pt-6">
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-6 py-3 font-semibold text-white shadow transition hover:bg-black">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 11c0-1.105.895-2 2-2s2 .895 2 2v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2c0-1.105.895-2 2-2m2-4a4 4 0 00-4 4v1h8V9a4 4 0 00-4-4z"/>
                            </svg>

                            Update Password
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);

        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = 'Hide';
        } else {
            input.type = 'password';
            button.textContent = 'Show';
        }
    }
</script>
@endsection