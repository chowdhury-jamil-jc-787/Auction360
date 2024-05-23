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
                        @if(auth()->user()->roles->first()->name == 'Super Admin' || (isset($bid) && $bid->product->user->id == auth()->id()))
                        <th scope="col">Action</th>
                        @endif
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
                        <td>
                            <!-- Delete and Approve Bid Buttons -->
                            <div class="btn-group" role="group">
                                {{-- {{ route('bids.approve', $bid->id) }} --}}
                                <!-- Approve Button -->
                                @if(auth()->user()->roles->first()->name == 'Super Admin' || $bid->product->user->id == auth()->id())
                                <form action="" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Do you want to approve this bid?');">Approve</button>
                                </form>

                                <!-- Space between buttons -->
                                <div class="p-1"></div>

                                <!-- Delete Button -->
                                <form action="{{ route('bids.destroy', $bid->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this bid?');">Delete</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger"><strong>You have not uploaded any products for bid!</strong></span>
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

