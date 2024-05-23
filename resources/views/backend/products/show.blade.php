<x-backend.layouts.master>

    <x-slot:fav>Products-Show</x-slot:fav>
    <x-slot:title>Products-Show</x-slot:title>

    @push('css')
    <style>

    </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $product->name }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $product->description }}</p>
                                <strong>Price:</strong>৳{{ $product->price }} <br>
                                <strong>Category Name:</strong> {{ $product->category->title }} <br>
                                <strong>User Name:</strong> <span class="badge bg-primary" style="color: white; font-size: 12px;">{{ $product->user->name }}</span> <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="media">
                            <img src="{{ asset($product->image) }}" class="mr-3" alt="foodcity">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>

    </script>
    @endpush

</x-backend.layouts.master>
