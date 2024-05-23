<x-backend.layouts.master>

    <x-slot:fav>Categories-Show</x-slot:fav>
    <x-slot:title1>Show</x-slot:title1>
        <x-slot:title>Categories-Show</x-slot:title>

        @push('css')
        <style>

        </style>
        @endpush

    <div class="container">
    <div class="card">

    <div class="card-header"><a href="{{ route('categories.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
    <div class="card-body">




    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>{{ $category->title }}</h4>
          </div>
          <div class="card-body">
            <p class="card-text">{{ $category->description }}</p>
            <strong>Status:</strong>
                {{ $category->is_active ? 'Active':'Inactive' }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="media">
          <img src="{{ asset($category->image) }}" class="mr-3" alt="foodcity">
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
