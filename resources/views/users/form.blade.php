<div>
    <label class="block mb-2 font-medium text-gray-700">Full Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
           class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block mb-2 font-medium text-gray-700">Email Address</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block mb-2 font-medium text-gray-700">Role</label>
    <select name="role"
            class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
        <option value="">Select Role</option>

        @foreach($roles as $role)
            <option value="{{ $role->name }}"
                {{ old('role', isset($user) ? $user->getRoleNames()->first() : '') == $role->name ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    @error('role')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block mb-2 font-medium text-gray-700">
        Password {{ isset($user) ? '(leave blank to keep current password)' : '' }}
    </label>
    <input type="password" name="password"
           class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block mb-2 font-medium text-gray-700">Confirm Password</label>
    <input type="password" name="password_confirmation"
           class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
</div>
