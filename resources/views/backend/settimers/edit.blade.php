<x-backend.layouts.master>
    <x-slot:fav>Set Timers - Edit</x-slot:fav>
    <x-slot:title>Set Timers - Edit</x-slot:title>

    @push('css')
    <style>
        #new-image-preview-box {
            width: 300px;
            height: 200px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        #new-image-preview-box img {
            max-width: 100%;
            max-height: 100%;
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

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('settimers.update', $setTimer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="select">Select Product</label>
                                    <select class="form-control" name="product_id" id="product_id" disabled>
                                        <option value="{{ $setTimer->product->id }}">{{ $setTimer->product->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ $setTimer->start_time->format('Y-m-d\TH:i') }}">
                                </div>
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $setTimer->end_time->format('Y-m-d\TH:i') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <!-- You can add preview for old image if needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function () {
            // JavaScript code here
        });
    </script>
    @endpush
</x-backend.layouts.master>
