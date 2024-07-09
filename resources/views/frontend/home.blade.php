<x-frontend.layouts.master>

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.startMainTop/>
        <!-- End Main Top -->

        <!-- Start Main Top -->
        <x-frontend.layouts.partials.header/>
        <!-- End Main Top -->

        <!-- Start Top Search -->
        <x-frontend.layouts.partials.topSearch/>
        <!-- End Top Search -->

        <!-- Start Slider -->
        <x-frontend.layouts.partials.slider :imageSliders="$imageSliders"/>
        <!-- End Slider -->


        <!-- Start Categories -->
        <div class="categories-section" style="text-align: center; margin-top: 84px;">
            <h2 style="font-size: 36px; font-weight: bold; color: #333; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px;">
                Categories
            </h2>
            <x-frontend.layouts.partials.categories :categories="$categories" />
        </div>
        <!-- End Categories -->

        <x-frontend.layouts.partials.box/>

    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Auction360 Recent Items</h1>
                        <p>Auction360 Recent Listings Display: Explore Our Latest Items.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            @foreach($categories as $category)
                                @if($category->is_active)
                                    <button data-filter=".{{ Str::slug($category->title) }}">{{ $category->title }}</button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @foreach($products as $product)
                    @php
                        // Check if the product has an associated set timer
                        $hasSetTimer = isset($product->end_time);

                        // Check if the set timer has expired
                        $isExpired = $hasSetTimer && strtotime($product->end_time) < time();
                    @endphp

                    {{-- Render the product only if it doesn't have a set timer or the set timer hasn't expired --}}
                    @if (!$hasSetTimer || !$isExpired)
                        <div class="col-lg-3 col-md-6 special-grid {{ Str::slug($product->category->title) }}">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">{{ $product->name }}</p>
                                    </div>

                                    <img src="{{ asset($product->image) }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="/bid/{{ $product->id }}/{{ auth()->user() ? auth()->user()->id : 'null' }}">Bid</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>{{ $product->description }}</h4>
                                    <h5>{{ $product->price }}</h5>
                                    {{-- Render the timer only if the product has an associated set timer --}}
                                    @if ($hasSetTimer)
                                        <div class="timer" data-end-time="{{ $product->end_time }}"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Get all timer elements
                    const timers = document.querySelectorAll('.timer');

                    // Function to update timer for each product
                    function updateTimer(timer) {
                        const endTime = new Date(timer.dataset.endTime).getTime();
                        const now = new Date().getTime();
                        let remainingTime = endTime - now;

                        if (remainingTime <= 0) {
                            timer.closest('.special-grid').style.display = 'none'; // Hide the product container
                        } else {
                            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                            remainingTime %= (1000 * 60 * 60 * 24);
                            const hours = Math.floor(remainingTime / (1000 * 60 * 60));
                            remainingTime %= (1000 * 60 * 60);
                            const minutes = Math.floor(remainingTime / (1000 * 60));
                            remainingTime %= (1000 * 60);
                            const seconds = Math.floor(remainingTime / 1000);

                            timer.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                        }
                    }

                    // Update timers every second
                    setInterval(function () {
                        timers.forEach(function (timer) {
                            updateTimer(timer);
                        });
                    }, 1000);

                    // Initial update
                    timers.forEach(function (timer) {
                        updateTimer(timer);
                    });
                });
            </script>







        </div>
    </div>





    {{-- start_blog --}}
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>About Auction's Product</h1>
                        <p>Exciting upcoming auction items await your bids on Auction360!.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="https://www.holmwood.co.nz/wp-content/uploads/2019/02/AdobeStock_73344826-1030x693.jpeg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Eligible Products for Bidding</h3>
                                <p>Sellers can upload a variety of products for bidding, including electronics, fashion items, collectibles, and more. Ensure that the items are legal and meet the platform's standards for quality and authenticity.</p>
                            </div>
                            {{-- <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="https://geauction.com/wp-content/uploads/2018/07/5-Auction-Tips-for-Beginners2.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Product Condition Requirements</h3>
                                <p>All products listed for bidding must be in good condition. New, gently used, or refurbished items are acceptable, but they must be accurately described. Any defects or issues should be clearly noted in the product description.</p>
                            </div>
                            {{-- <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="https://geauction.com/wp-content/uploads/2018/06/Your-First-Auction-What-You-Need-to-Know.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Documentation and Verification</h3>
                                <p>Sellers must provide clear images and detailed descriptions of their products. Verification documents, such as proof of authenticity or purchase receipts, may be required for high-value items to ensure trust and transparency.</p>
                            </div>
                            {{-- <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end_blog --}}

        <!-- Start Instagram Feed  -->
        <x-frontend.layouts.partials.instagramFeed :galleries="$galleries" />
        <!-- End Instagram Feed  -->


        <!-- Start Footer  -->
        <x-frontend.layouts.partials.footer/>
        <!-- End Footer  -->

</x-frontend.layouts.master>

