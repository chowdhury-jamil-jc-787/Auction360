<x-backend.layouts.master>
    <x-slot:fav>Categories-Create</x-slot:fav>
        <x-slot:title>Categories-create</x-slot:title>

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

    <div class="card-header"><a href="{{ route('categories.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
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
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="text">Name</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter category title">
            </div>
            <div class="form-group">
              <label for="textarea">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description here"></textarea>
            </div>
            <div class="form-group">
              <label for="select">Select</label>
              <select name="is_active" class="form-control" id="is_active">
                        <option value="1">Active</option>
              <option value="0">InActive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="datetime">Created at</label>
              <input type="datetime-local" name="created_at" class="form-control" id="datetime">
            </div>
            <div class="form-group">
              <label for="image">Upload Image</label>
              <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </form>
        </div>
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
                $(document).ready(function() {
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
