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
                            <li class="breadcrumb-item active">Top 10 Winner Bidder</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->





            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bid ID</th>
                            <th>Product Name</th>
                            <th>Bid</th>
                            <th>User Name</th>
                            <th>Bid Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedBids as $bid)
                            <tr>
                                <td>{{ $bid->id }}</td>
                                <td>{{ $bid->product_name }}</td>
                                <td>{{ $bid->bid }}</td>
                                <td>{{ $bid->user_name }}</td>
                                <td>{{ $bid->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $completedBids->links() }}
            </div>

















            <!-- Start Footer  -->
    <x-frontend.layouts.partials.footer/>
    <!-- End Footer  -->

</x-frontend.layouts.master>
