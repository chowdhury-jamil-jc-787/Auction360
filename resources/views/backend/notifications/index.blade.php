<x-backend.layouts.master>
    <x-slot:fav>Notifications</x-slot:fav>
    <x-slot:title>Notifications</x-slot:title>
    @push('css')
    <link href="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="col-lg-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('errors'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <!-- No need for additional content in the header -->
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Product ID</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>User Name</th>
                            <th>Action</th> <!-- Add Action column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unreadNotifications as $index => $notification)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $notification['product_name'] }}</td>
                                <td>{{ $notification['start_time'] }}</td>
                                <td>{{ $notification['end_time'] }}</td>
                                <td>{{ $notification['user_name'] }}</td>
                                <td class="text-nowrap">
                                    <form action="{{ route('notifications.reject', $notification['notifiable_id']) }}" method="POST">
                                        @can('set-timer-edit')
                                            <a class="btn btn-primary" href="/notifications/{{ $notification['notifiable_id'] }}/approve">Approve</a>
                                        @endcan
                                        @csrf
                    
                                        @can('set-timer-delete')
                                            <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to reject?')){ this.closest('form').submit(); }" class="btn btn-danger">Reject</button>
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
