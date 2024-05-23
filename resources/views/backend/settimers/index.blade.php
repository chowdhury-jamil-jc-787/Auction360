<x-backend.layouts.master>
    <x-slot:fav>Set Timers</x-slot:fav>
    <x-slot:title>Set Timers</x-slot:title>
    @push('css')
    <link href="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="col-lg-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <!-- Add Set Timer Button -->
                <div>
                    @can('set-timer-create')
                        <a href="{{ route('settimers.create') }}" class="btn btn-success">Add Set Timer</a>
                    @endcan
                </div>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th class="text-nowrap">Created at</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th class="text-nowrap">Created at</th>
                            <th width="280px">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $currentPage = $setTimers->currentPage();
                            $perPage = $setTimers->perPage();
                            $offset = ($currentPage - 1) * $perPage;
                        @endphp
                        @foreach ($setTimers as $setTimer)
                            <tr>
                                <th>{{ $loop->iteration + $offset }}</th>
                                <td>{{ $setTimer->product->name }}</td>
                                <td>{{ $setTimer->start_time }}</td>
                                <td>{{ $setTimer->end_time }}</td>
                                <td class="text-nowrap">{{ $setTimer->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="text-nowrap">
                                    <form action="{{ route('settimers.destroy', $setTimer->id) }}" method="POST">
                                        @can('set-timer-edit')
                                            <a class="btn btn-primary" href="{{ route('settimers.edit', $setTimer->id) }}">Edit</a>
                                        @endcan
                                        @csrf
                                        @method('DELETE')
                                        @can('set-timer-delete')
                                            <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this set timer?')){ this.closest('form').submit(); }" class="btn btn-danger">Delete</button>
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
            {{ $setTimers->links() }}
        </div>
    </div>
    @push('js')
        <script src="{{ asset('ui/backend/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>
    @endpush
</x-backend.layouts.master>
