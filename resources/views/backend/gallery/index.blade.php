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
                            @can('category-create')
                                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Gallery</a>
                            @endcan
                        </div>
                        <div>
                            @can('category-trashed')
                                <a href="{{ route('categories.trashed') }}" class="btn btn-warning">Trashed</a>
                            @endcan
                        </div>
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

                        </tbody>

                      </table>
                      <br>


                    </div>
                    <br>

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
