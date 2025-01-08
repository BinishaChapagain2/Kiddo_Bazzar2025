<section class="max-w-3xl p-6 mx-auto bg-white border border-gray-200 shadow dark:bg-gray-800 md:p-8 lg:p-10">
    <header>
        <h2 class="mb-4 text-xl font-bold text-yellow-600 underline lg:text-2xl dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="text-sm text-yellow-500 dark:text-gray-400">
            {{ __('Ensure your account and password is Secure !') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 "
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- New Password Field -->
        <div>
            <x-input-label for="update_password_password" :value="__('New Password:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 "
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Confirm Password Field -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 "
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Save Button and Status Message -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="px-6 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 ">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
