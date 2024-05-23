<x-backend.layouts.master>
    <x-slot:fav>Set Timers - Create</x-slot:fav>
    <x-slot:title>Set Timers - Create</x-slot:title>

    @push('css')
    <style>
        .preview-box {
            width: 300px;
            height: 300px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preview-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
    @endpush

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('settimers.index') }}" class="btn btn-success btn-sm float-end">Back</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('settimers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="select">Select Product</label>
                                    <select name="product_id" class="form-control" id="product_id">
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                                </div>
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function () {
            // You can add JavaScript logic here if needed
        });
    </script>
    @endpush
</x-backend.layouts.master>
