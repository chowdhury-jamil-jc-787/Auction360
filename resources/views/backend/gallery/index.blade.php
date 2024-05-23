<x-backend.layouts.master>
    <x-slot:fav>Galleries</x-slot:fav>
        <x-slot:title>Galleries</x-slot:title>
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
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <div>
                            @can('gallery-create')
                                <a href="{{ route('galleries.create') }}" class="btn btn-success">Add Gallery</a>
                            @endcan
                        </div>
                        <div>
                            @can('gallery-trashed')
                                <a href="{{ route('galleries.trashed') }}" class="btn btn-warning">Trashed</a>
                            @endcan
                        </div>
                    </div>

                    <div class="table-responsive p-3">
                      <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                          <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th width="280px">Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th width="280px">Action</th>
                          </tr>
                        </tfoot>
                        <tbody>

                            @php
                                    $currentPage = $galleries->currentPage();
                                    $perPage = $galleries->perPage();
                                    $offset = ($currentPage - 1) * $perPage;
                                @endphp
                                @foreach ($galleries as $gallery)
                                    <tr>
                                        <th>{{ $loop->iteration + $offset }}</th>
                                        <td><img src="{{ asset($gallery->image) }}" width="100px" style="width: 100px; height: 100px; overflow: hidden;"></td>
                                        <td>{{ $gallery->name }}</td>
                                        <td>
                                            @if($gallery->is_active == 1)
                                                Active
                                            @else
                                                InActive
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <form action="{{ route('galleries.destroy',$gallery->id) }}" method="POST">
                                                @can('gallery-show')
                                                    <a class="btn btn-info" href="{{ route('galleries.show',$gallery->id) }}">Show</a>
                                                @endcan
                                                @can('gallery-edit')
                                                    <a class="btn btn-primary" href="{{ route('galleries.edit',$gallery->id) }}">Edit</a>
                                                @endcan
                                                @csrf
                                                @method('DELETE')
                                                @can('gallery-delete')
                                                    <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){ this.closest('form').submit(); }" class="btn btn-danger">Delete</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>

                      </table>
                      <br>


                    </div>
                    <br>
                    {{ $galleries->links() }}

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
