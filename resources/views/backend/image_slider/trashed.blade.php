<x-backend.layouts.master>
    <x-slot:fav>Image_slider-trashed</x-slot:fav>
    <x-slot:title>Image_slider-trashed</x-slot>

    @push('css')
    <link href="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <!-- Datatables -->

        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <a href="{{ route('imageslider.list') }}" class="btn btn-success">Back</a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trashed as $image_slider)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="100" width="150"></td>
                                        <td>{{ $image_slider->title }}</td>
                                        <td>{{ $image_slider->description }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('image_slider.restore', ['image_slider'=> $image_slider->id])}}" class="btn btn-warning me-2">Restore img</a>
                                                <form onsubmit="return confirm('Are you sure you want to delete this forever?')" action="{{ route('image_slider.delete', ['image_slider'=> $image_slider->id])}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" style="margin-left: 10px;">Permanently Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


    @push('js')
        <script src="{{ asset('ui/backend/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>
    @endpush
</x-backend.layouts.master>
