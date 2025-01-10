@if (Session::has('successdelivered'))
    @auth
        <div class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300 ease-in-out bg-gray-800 bg-opacity-50"
            id="review-popup">
            <div class="w-full max-w-md p-6 mx-4 transition-all duration-300 ease-in-out transform scale-90 bg-white rounded-lg shadow-xl opacity-0 review-form lg:mx-0"
                id="review-form">
                <h2 class="pl-2 mb-4 text-2xl font-semibold text-gray-800 border-l-4 border-yellow-500">Leave a Review</h2>
                <form action="{{ route('review.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex flex-col mb-4 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        <label for="rating" class="flex items-center font-medium text-gray-700">Rating:
                            <select name="rating" id="rating"
                                class="p-2 ml-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label for="review" class="block mb-2 font-medium text-gray-700">Review:</label>
                        <textarea name="review" id="review" rows="4"
                            class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" required></textarea>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-[#9a031fdd] rounded-lg hover:bg-[#8a021c] transition duration-200">Submit
                            Review</button>
                        <button type="button" onclick="closeReviewForm()" class="text-gray-600 focus:outline-none">
                            <i class="text-2xl bx bx-x"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function closeReviewForm() {
                document.getElementById('review-popup').classList.add('opacity-0');
                document.getElementById('review-popup').classList.add('pointer-events-none');
                setTimeout(() => {
                    document.getElementById('review-popup').style.display = 'none';
                }, 500); // Wait for fade-out to complete
            }

            // Show popup with smooth animation
            window.onload = () => {
                const popup = document.getElementById('review-popup');
                setTimeout(() => {
                    popup.style.display = 'flex';
                    popup.querySelector('#review-form').classList.remove('opacity-0', 'scale-90');
                    popup.querySelector('#review-form').classList.add('opacity-100', 'scale-100');
                }, 200); // Delay popup appearance for smooth transition
            }

            // Auto close after 3 seconds
            setTimeout(() => {
                closeReviewForm();
            }, 20000); // Close after 20 seconds
        </script>
    @endauth
@endif
