<x-backend.layouts.master>
    <x-slot:fav>products-Create</x-slot:fav>
    <x-slot:title>Products-create</x-slot:title>

    @push('css')
    <style>
        .preview-box {
            width: 300px;
            height: 300px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preview-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
    @endpush

    <div class="container">
        <div class="card">

            <div class="card-header"><a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label for="text">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                                </div>
                                <div class="form-group">
                                    <label for="textarea">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description here"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="select">Select category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="number">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price here">
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload Image</label>
                                    <input type="file" name="image" class="form-control-file" id="image">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        <div class="col-md-6">
                            <div class="preview-box">
                                <img id="preview" src="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function () {
            $("#image").change(function () {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                    $('.preview-box').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-backend.layouts.master>
