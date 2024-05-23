
<x-backend.layouts.master>
    <x-slot:fav>Categories-trashed</x-slot:fav>
        <x-slot:title>Categories-trashed</x-slot:title>
        @push('css')
        <link href="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        @endpush

         <!-- Datatables -->
         <div class="col-lg-12">
                @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
                  <div class="card mb-4">
                    <div class="card-header py-3  flex-row align-items-center justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-success">Back</a>
                    </div>
                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                          <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th class="text-nowrap">Created at</th>
                          <th width="280px">Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th class="text-nowrap">Created at</th>
                          <th width="280px">Action</th>
                          </tr>
                        </tfoot>
                        <tbody>

                        @foreach ($trashed as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ asset($category->image) }}" width="100px" style="  width: 100px; height: 100px; overflow: hidden;"></td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>
                @if($category->is_active == 1)
                Active
                @else
                InActive
                @endif
                  </td>
                  <td>{{ $category->created_at->longAbsoluteDiffForHumans() }}</td>
                <td class="text-nowrap">
                    <form action="{{ route('categories.trashed.delete',$category->id) }}" method="POST">
                        @can('category-trashed-restore')
                        <a class="btn btn-primary" href="{{ route('categories.trashed.restore',$category->id) }}">restore</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('category-trashed-delete')
                        <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){ this.closest('form').submit(); }" class="btn btn-danger">Permanently Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- DataTable with Hover -->

                @push('js')
              <script src="{{ asset('ui/backend/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
              <script src="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

              <!-- Page level custom scripts -->
              <script>
              $(document).ready(function () {
              $('#dataTable').DataTable(); // ID From dataTable
              $('#dataTableHover').DataTable(); // ID From dataTable with Hover
              });
              </script>
              @endpush

    </x-backend.layouts.master>
