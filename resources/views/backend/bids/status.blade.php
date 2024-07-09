<x-backend.layouts.master>

    <x-slot:title1>Bids</x-slot:title1>
    <x-slot:title>bids</x-slot:title>

    <div class="card">
        <div class="card-header">Manage Bids</div>

        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                        <th width="280px">Action</th>
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
                            <td class="text-nowrap">
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
                                <form action="{{ route('orders.reject', $bid->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    @if ($bid->status == 'approved')
                                        <a class="btn btn-success" href="/invoice/{{ $bid->id }}">Payment</a>
                                    @endif
                                    @if ($bid->status == 'approved' || $bid->status == 'pending')
                                        <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to reject this bid?')) { this.closest('form').submit(); }" class="btn btn-danger">Reject</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
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
