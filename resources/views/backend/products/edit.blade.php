<x-backend.layouts.master>

    <x-slot:fav>Products-Edit</x-slot:fav>
    <x-slot:title>Products-Edit</x-slot:title>

    @push('css')
    <style>

        #new-image-preview-box {
            width: 300px;
            height: 200px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        #new-image-preview-box img {
            max-width: 100%;
            max-height: 100%;
        }

    </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('products.index') }}" class="btn btn-success btn-sm float-end">Back</a>
            </div>
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

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="text">Name:</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="textarea">Description:</label>
                                    <textarea class="form-control" name="description" id="description">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="select">Select option:</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option <?php if($category->id==$product->category->id) echo 'selected="selected"';?> value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="number">Price</label>
                                    <input type="number" class="form-control" value="{{ $product->price }}" id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="number">User Name</label>
                                    <input type="text" class="form-control" value="{{ $product->user->name }}" id="user_name" name="user_name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image:</label>
                                    <input type="file" name="image" class="form-control-file" id="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id="old-image-box">
                                <img src="{{ asset($product->image) }}" alt="Old image">
                            </div>
                            <br>
                            <div id="new-image-preview-box"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('js')
    <script>

        $(document).ready(function() {
            // Show new image preview box after image has been selected
            $('#image').change(function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#new-image-preview-box').html('<img src="' + e.target.result + '" title="' + input.files[0].name + '">');
                        $('#new-image-preview-box').show();
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    @endpush
</x-backend.layouts.master>

