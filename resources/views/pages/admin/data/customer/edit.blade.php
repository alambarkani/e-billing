<div x-data="{ open: false }">
    <button @click="open = !open">Ubah Password</button>

    <div x-show="open" class="sm:col-span-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" name="password" id="password" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="••••••••">
        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div x-show="open" class="sm:col-span-2">
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
            Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="••••••••">
        @error('password-confirmation')
            <div>{{ $message }}</div>
        @enderror
    </div>
</div>
