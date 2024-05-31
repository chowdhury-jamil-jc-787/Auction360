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

            <!-- Search Form -->
            <form id="search-form" class="mb-4">
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search by product name" value="{{ request('search') }}">
                </div>
            </form>

            <!-- Displaying existing bids -->
            <div id="bids-table">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product</th>
                            <th scope="col">P.Owner</th>
                            <th scope="col">Bid Amount</th>
                            <th scope="col">Bidding BY</th>
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
                            <td>{{ $bid->user->name }}</td>
                            @if(auth()->user()->roles->first()->name == 'Super Admin' || $bid->product->user->id == auth()->id())
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Do you want to approve this bid?');">Approved</button>
                                    </form>
                                    <div class="p-1"></div>
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to reject this bid?');">Reject</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <span class="text-danger"><strong>You have not uploaded any products for bid!</strong></span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <br>
            <div id="pagination-links">
                {{ $bids->links() }}
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        // Function to fetch bids based on the search query
        function fetchBids(searchQuery = '') {
            let url = new URL('{{ route("bids.index") }}');
            url.searchParams.append('search', searchQuery);

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update the bids table and pagination links
                document.getElementById('bids-table').innerHTML = data.bids;
                document.getElementById('pagination-links').innerHTML = data.pagination;
            });
        }

        // Event listener for the input event on the search input field
        document.getElementById('search').addEventListener('input', function() {
            let searchQuery = this.value.trim(); // Trim any leading or trailing spaces
            fetchBids(searchQuery); // Fetch bids based on the search query
        });

        // Handle pagination links click
        document.addEventListener('click', function(event) {
            if (event.target.closest('.pagination a')) {
                event.preventDefault();
                let url = event.target.closest('.pagination a').href;
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('bids-table').innerHTML = data.bids;
                    document.getElementById('pagination-links').innerHTML = data.pagination;
                });
            }
        });
    </script>

    @endpush

</x-backend.layouts.master>
