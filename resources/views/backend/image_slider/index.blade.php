<x-backend.layouts.master>
    <x-slot:fav>Image_slider</x-slot:fav>
        <x-slot:title>Image_slider</x-slot:title>
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
                        @can('imageslider.create')
                            <a href="{{ route('imageslider.create') }}" class="btn btn-success">Add Image</a>
                        @endcan
                    </div>
                    <div>
                        @can('imagesliders.trashed')
                            <a href="{{ route('imagesliders.trashed') }}" class="btn btn-warning">Trashed</a>
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
                          <!-- <th class="text-nowrap">Created at</th> -->
                          <th width="280px">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                            @php
                            $currentPage = $images->currentPage();
                            $perPage = $images->perPage();
                            $offset = ($currentPage - 1) * $perPage;
                        @endphp
                                            @foreach($images as $image_slider)
                                            <tr>
                                            <td>{{ $loop->iteration + $offset }}</td>
                                            <td><img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="100" width="150" ></td>

                                                <td>{{$image_slider->title}}</td>
                                                <td>{{$image_slider->description}} </td>
                                                <td>{{$image_slider->is_active}} </td>

                                                <td>
                                               <a href="{{ route('imagesliders.show', ['image_slider'=> $image_slider->id])}}" class="btn btn-info">Show</a>
                                              <a href="{{ route('imagesliders.edit', ['image_slider'=> $image_slider->id])}}" class="btn btn-warning">Edit</a>
                                              <form style="display:inline;" action="{{ route('imagesliders.destroy', ['image_slider'=> $image_slider->id])}}" method="POST">
                                                   <form action="{{route('imagesliders.destroy',['image_slider'=> $image_slider->id])}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                    </form>
                                                </td>
                                                @endforeach

                                            </tr>

                                        </tbody>

                        <tfoot>
                          <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Status</th>
                          <!-- <th class="text-nowrap">Created at</th> -->
                          <th width="280px">Action</th>
                          </tr>
                        </tfoot>
                        <tbody>


                        </tbody>
                      </table>
                      <br>
                        {{ $images->links() }}
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
