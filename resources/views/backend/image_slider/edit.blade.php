<x-backend.layouts.master>
    <x-slot:fav>Image_slider-Edit</x-slot:fav>
    <x-slot:title>Image_slider-Edit</x-slot:title>

    @push('css')
    <style>
        .card-body {
            padding: 20px;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .preview-box {
            margin-top: 20px;
        }

        .form-check-input:checked + .form-check-label::before {
            background-color: #007bff;
            border-color: #007bff;
        }

        #description {
            resize: vertical;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .image-container {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .image-container img {
            margin-bottom: 10px;
            max-width: 150px;
        }

        .btn-back {
            margin-top: 20px;
        }

        .new-image-preview-box {
            margin-top: 20px;
        }

        .new-image-preview-box img {
            max-width: 150px;
        }
    </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end btn-back">Back</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('imagesliders.update',['image_slider'=> $image_slider->id])}}" method="Post"
                      enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" value="{{ old('title',$image_slider->title)}}" id="title" name="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description',$image_slider->description)}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input status-checkbox" id="is_active" name="is_active" value="1" {{ $image_slider->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input status-checkbox" id="is_inactive" name="is_inactive" value="0" {{ !$image_slider->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_inactive">Inactive</label>
                        </div>
                    </div>

                    <div class="image-container">
                        <div>
                            <label for="image" class="form-label">Image</label>
                            <img id="preview" src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="100" width="150">
                        </div>
                        <div>
                            <input type="file" value="{{$image_slider->image}}" class="form-control" id="image" name="image">
                            <div class="new-image-preview-box" style="display: none;">
                                <strong>New Image Preview:</strong><br>
                                <img id="new-preview" src="" alt="New Image Preview">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function () {
            $('.status-checkbox').click(function() {
                $('.status-checkbox').prop('checked', false);
                $(this).prop('checked', true);
            });

            $("#image").change(function () {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#new-preview').attr('src', e.target.result);
                        $('.new-image-preview-box').show();
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
    @endpush
</x-backend.layouts.master>
