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


        <!-- Start All Title Box -->
        <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Bid</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Details for bid</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->










        <div class="container my-5">
            @if(session('error'))
    <div class="alert alert-danger">
        <strong>Error: </strong>{{ session('error') }} ({{ session('error_code') }})
    </div>
@endif
            <div class="row">
                <div class="col-md-5">
                    <div class="main-img">
                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="ProductS">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="main-description px-2">
                        <div class="category text-bold">
                            Category: {{ $product->category->title }}
                        </div>
                        <div class="product-title text-bold my-3">
                            Product: {{ $product->name }}
                        </div>


                        <div class="price-area my-4">

                            <p class="new-price text-bold mb-1">৳{{ $product->price }}</p>
                            <p class="text-secondary mb-1">(This is the bidding start price)</p>

                        </div>


                        <form action="/submit_bid" method="POST">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $product->category->id }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="buttons d-flex my-5">
                                <div class="block quantity">
                                    <input type="number" class="form-control" id="bid" value="{{ $product->price }}" placeholder="Enter bid" name="bid" min="{{ $product->price }}" style="width: 80px;">
                                </div>
                                <div class="block">
                                    <button type="submit" class="shadow btn btn-success custom-btn">Submit</button>
                                </div>
                            </div>
                        </form>





                    </div>

                    <div class="product-details my-4">
                        <p class="details-title text-color mb-1">Product Details</p>
                        <p class="description">{{ $product->description }}</p>
                    </div>

                    <div class="row questions bg-light p-3">
                        <div class="col-md-1 icon">
                            <i class="fa-brands fa-rocketchat questions-icon"></i>
                        </div>
                        <div class="col-md-11 text">
                            Have a question about our items at Auction360? Feel free to contact our representatives via live chat or email.
                        </div>
                    </div>

                    <div class="delivery my-4">
                        <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-truck"></i></span> <b>Delivery done when you win the bid</b> </p>
                        <p class="text-secondary">After winning you get notification</p>
                    </div>

             </div>
            </div>
        </div>



        <script>
            document.getElementById('bid').addEventListener('input', function() {
                var minValue = parseFloat(this.getAttribute('min'));
                var currentValue = parseFloat(this.value);

                if (currentValue < minValue) {
                    this.value = minValue;
                }
            });
        </script>


    <!-- Start Instagram Feed  -->

    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
    <x-frontend.layouts.partials.footer/>
    <!-- End Footer  -->

</x-frontend.layouts.master>
