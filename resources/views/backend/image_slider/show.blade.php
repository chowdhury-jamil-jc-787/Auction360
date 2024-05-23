<x-backend.layouts.master>

    <x-slot:fav>Image_slider-Show</x-slot:fav>
    <x-slot:title>Image_slider-Show</x-slot:title>

    @push('css')
    <style>
        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .image-container img {
            margin-bottom: 10px;
            max-width: 200px;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end btn-back">Back</a>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('message')}}
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Title:</label>
                    <p>{{ $image_slider->title }}</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Description:</label>
                    <p>{{ $image_slider->description }}</p>
                </div>

                <div class="image-container">
                    <label class="form-label">Image:</label>
                    <img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="150" width="200">
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        // Any JavaScript if required can be added here
    </script>
    @endpush

</x-backend.layouts.master>
