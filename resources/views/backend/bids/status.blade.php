<x-backend.layouts.master>

    <x-slot:title1>Bids</x-slot:title1>
    <x-slot:title>bids</x-slot:title>

    <div class="card">
        <div class="card-header">Manage Bids</div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">

            <!-- Displaying existing bids -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product</th>
                        <th scope="col">P.Owner</th>
                        <th scope="col">Bid Amount</th>
                        <th scope="col">B.Person</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bids as $bid)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bid->category->title }}</td>
                        <td>{{ $bid->product->name }}</td>
                        <td>{{ $bid->product->user->name }}</td>
                        <td>{{ $bid->bid }}</td>
                        <td>{{ $bid->user->name }}</td>
                        <td>
                            @if($bid->status == 'approved')
                                <span class="badge badge-success">{{ ucfirst($bid->status) }}</span>
                            @elseif($bid->status == 'pending')
                                <span class="badge badge-warning">{{ ucfirst($bid->status) }}</span>
                            @elseif($bid->status == 'rejected')
                                <span class="badge badge-danger">{{ ucfirst($bid->status) }}</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($bid->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <form action="" method="POST">
                                @if ($bid->status == 'approved')
                                <a class="btn btn-success" href="">Payment</a>
                                @endif
                            @csrf
                                <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to reject this post?')){ this.closest('form').submit(); }" class="btn btn-danger">Reject</button>
                        </form></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger"><strong>No Bids Found!</strong></span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>

            {{ $bids->links() }}

        </div>
    </div>

</x-backend.layouts.master>

