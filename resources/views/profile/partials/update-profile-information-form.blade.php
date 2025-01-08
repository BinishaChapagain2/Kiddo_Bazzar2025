<section class="max-w-3xl p-6 mx-auto bg-white border border-gray-200 shadow dark:bg-gray-800 md:p-8 lg:p-10">
    <header>
        <h2 class="mb-4 text-xl font-bold text-yellow-600 underline lg:text-2xl dark:text-gray-100">
            {{ __('Personal Information') }}
        </h2>
        <p class="text-sm text-yellow-500 dark:text-gray-400">
            {{ __('Ensure your personal information is correct !') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Name:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="name" name="name" type="text"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 " :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('name')" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Email:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="email" name="email" type="email"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 " :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800 dark:text-gray-400">
                    <p>
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="ml-2 text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Profile Picture Field -->
        <div>
            <x-input-label for="profilePicture" :value="__('Profile Picture:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="profilePicture" name="profilePicture" type="file"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 " />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('profilePicture')" />

            <p class="mt-2 text-sm text-gray-900 dark:text-gray-300">Current Profile Picture:</p>
            <img src="{{ $user->profilePicture ? asset('images/profilePictures/' . $user->profilePicture) : asset('images/profilePictures/default.png') }}"
                alt="Profile Picture" class="w-24 h-24 mt-3 border border-gray-300 rounded-full dark:border-gray-600">
        </div>

        <!-- Phone Field -->
        <div>
            <x-input-label for="phone" :value="__('Phone:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="phone" name="phone" type="text"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 " :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('phone')" />
        </div>

        <!-- Gender Field -->
        <div>
            <x-input-label for="gender" :value="__('Gender:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <select id="gender" name="gender"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 ">
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                    {{ __('Male') }}
                </option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                    {{ __('Female') }}
                </option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>
                    {{ __('Other') }}
                </option>
            </select>
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('gender')" />
        </div>

        <!-- Address Field -->
        <div>
            <x-input-label for="address" :value="__('Address:')"
                class="text-lg font-semibold text-gray-900 dark:text-gray-300" />
            <x-text-input id="address" name="address" type="text"
                class="w-full p-2 mt-2 border border-gray-300 rounded-lg dark:border-gray-600 " :value="old('address', $user->address)" />
            <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('address')" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button
                class="px-6 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
