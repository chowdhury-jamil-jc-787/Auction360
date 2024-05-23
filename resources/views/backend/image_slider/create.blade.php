<x-backend.layouts.master>

    <x-slot:fav>Image_slider-Create</x-slot:fav>
    <x-slot:title>Image_slider-create</x-slot:title>

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
    </style>
    @endpush



        <div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form action="{{ route('imageslider.store')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" value="{{ old('title')}}" id="title" name="title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description')}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="active" name="is_active" value="1">
                            <label class="form-check-label" for="active">Active</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="inactive" name="is_active" value="0">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="preview-box">
                        <img id="preview" src="">
                    </div>
                </div>
            </div>
        </div>
    @push('js')
    <script>
        $(document).ready(function() {
            $("#active").click(function() {
                $("#inactive").prop('checked', false);
            });

            $("#inactive").click(function() {
                $("#active").prop('checked', false);
            });

            $("#image").change(function() {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $('.preview-box').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
    </x-backend.layouts.master>
