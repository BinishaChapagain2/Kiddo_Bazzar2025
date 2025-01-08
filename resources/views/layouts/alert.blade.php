@if (Session::has('success'))
    <div class="fixed z-50 bottom-10 right-5" id="message">
        <div
            class="relative flex items-center justify-between w-full max-w-sm px-4 py-3 text-white bg-[#9a031fee] rounded-lg shadow-lg animate-fade-in-out">
            <p class="text-base font-semibold lg:text-lg ">{{ session('success') }}</p>
            <!-- Close Button -->
            <button onclick="document.getElementById('message').style.display = 'none';"
                class="ml-4 text-white focus:outline-none">
                <i class="text-2xl bx bx-x"></i> <!-- Boxicons close icon -->
            </button>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('message').style.display = 'none';
        }, 3000); // Show for 3 seconds
    </script>
@endif
