<x-frontend.layouts.master>
    @push('css')
    <style>
        /* Add any custom CSS here if needed */
        .card-custom {
            min-width: 300px; /* Minimum width for cards */
            width: calc(33.333% - 20px); /* 3 cards per row with 20px spacing */
            height: 100%;
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px; /* Add margin at the bottom */
            margin-right: 20px; /* Add margin on the right */
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-img-top-custom {
            height: 200px; /* Fixed height for images */
            object-fit: cover; /* Ensure the image covers the entire container */
        }

        .card-body-custom {
            padding: 20px; /* Increased padding for larger content */
        }

        .category-container {
            max-width: 250px;
        }

        .category-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        @media (max-width: 992px) {
            .card-custom {
                width: calc(50% - 20px); /* 2 cards per row with 20px spacing */
            }
        }

        @media (max-width: 768px) {
            .card-custom {
                width: 100%; /* Full width on smaller screens */
                margin-right: 0; /* Remove right margin on smaller screens */
                margin-bottom: 20px; /* Add bottom margin on smaller screens */
            }
        }
    </style>
    @endpush

    <!-- Start Main Top -->
    <x-frontend.layouts.partials.startMainTop/>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <x-frontend.layouts.partials.header/>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <x-frontend.layouts.partials.topSearch/>
    <!-- End Top Search -->

    <div class="container bg-white p-4 d-flex">
        <div class="category-container border rounded p-3 mr-4">
            <h1 class="font-bold text-lg text-gray-700">Categories</h1>
            <div id="category-list">
                @foreach ($categories as $category)
                    <div class="flex items-center my-2">
                        <input type="radio" name="category" class="mr-2" onclick="filterProducts('{{ $category->id }}')">
                        <label>{{ $category->title }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-1 mx-auto" id="card-container">
            @foreach ($categories as $category)
                <div id="category-{{ $category->id }}" class="category-products" style="display:none;">
                    @foreach ($productsByCategory[$category->id] as $product)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                            <div class="card card-custom shadow-md rounded overflow-hidden">
                                <img class="card-img-top card-img-top-custom" src="{{ $product->image }}" alt="{{ $product->name }}" />
                                <div class="card-body card-body-custom">
                                    <h5 class="card-title font-semibold text-slate-800">{{ $product->name }}</h5>
                                    <p class="card-text text-sm leading-5">{{ $product->description }}</p>
                                    <p class="card-text text-red-400 font-semibold">${{ number_format($product->price, 2) }}</p>
                                    <button class="btn btn-outline-teal btn-sm mt-2">ADD TO CART</button>
                                    @if ($product->end_time)
                                        <div class="timer mt-2" data-end-time="{{ $product->end_time }}"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 w-100">
                        {{ $productsByCategory[$category->id]->links() }} <!-- Pagination links for each category -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function filterProducts(categoryId) {
            // Hide all category product divs
            document.querySelectorAll('.category-products').forEach(function(categoryDiv) {
                categoryDiv.style.display = 'none';
            });

            // Show the selected category product div
            document.getElementById('category-' + categoryId).style.display = 'flex';
        }

        // Initially show all products
        document.getElementById('category-{{ $categories->first()->id }}').style.display = 'flex';

        // Timer countdown logic
        document.querySelectorAll('.timer').forEach(function(timerElement) {
            const endTime = new Date(timerElement.getAttribute('data-end-time')).getTime();

            const updateTimer = () => {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance < 0) {
                    timerElement.innerHTML = "EXPIRED";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                timerElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            };

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>

    <!-- Start Footer -->
    <x-frontend.layouts.partials.footer/>
    <!-- End Footer -->

</x-frontend.layouts.master>
