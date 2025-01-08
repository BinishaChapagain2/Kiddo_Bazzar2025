<div class="max-w-3xl p-6 mx-auto bg-white border border-gray-200 shadow dark:bg-gray-800 md:p-8 lg:p-10">

    <header>
        <h2 class="mb-4 text-xl font-bold text-yellow-600 underline lg:text-2xl dark:text-gray-100">
            {{ __('Delete Your Account') }}
        </h2>
        <p class="text-sm text-yellow-500 dark:text-gray-400">
            {{ __(' This action is permanent and cannot be
                                                                                                                                                                                                                                                                                                                        undone !') }}
        </p>
    </header>

    @if (session('status'))
        <div
            class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-400 dark:border-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-6 ">
        @csrf
        @method('DELETE')

        <!-- Password Confirmation Field -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-semibold text-gray-900 dark:text-gray-300">
                Confirm Your Password
            </label>
            <input type="password" name="password" id="password"
                class="w-full p-3 mt-2 text-gray-800 placeholder-gray-400 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 "
                placeholder="Enter your password" required>

            @error('password')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Delete Account Button -->
        <div class="mb-6">
            <button type="submit" class="px-6 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 ">
                Delete Account
            </button>
        </div>
    </form>



</div>
