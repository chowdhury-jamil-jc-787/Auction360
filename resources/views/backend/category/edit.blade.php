<x-backend.layouts.master>
    <x-slot:fav>Categories-Edit</x-slot:fav>
    <x-slot:title1>Categories-Edit</x-slot:title1>
        <x-slot:title>Categories-Edit</x-slot:title>

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


    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
              <label for="text">Title:</label>
              <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="title">
            </div>
            <div class="form-group">
              <label for="textarea">Description:</label>
              <textarea class="form-control" name="description" id="description">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="select">Select option:</label>
              <select class="form-control" name="is_active" id="is_active">
              <option value="1" <?php if($category->is_active == 1) echo 'selected="selected"'; ?>>Active</option>
                        <option value="0" <?php if($category->is_active == 0) echo 'selected="selected"'; ?>>InActive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="datetime">Date and time:</label>
              <input type="datetime-local" name="created_at" id="created_at" value="{{ $category->created_at }}" class="form-control" id="datetime">
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
            <img src="{{ asset($category->image) }}" alt="Old image">
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
