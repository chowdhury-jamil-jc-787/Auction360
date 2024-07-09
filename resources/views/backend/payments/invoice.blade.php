<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .border-top-red {
            border-top: 12px solid #9f181c;
        }
        .border-bottom-black {
            border-bottom: 12px solid #333333;
        }
        .receipt-main {
            background: #ffffff;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 40px 30px !important;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: 'Open Sans', sans-serif;
        }
        .receipt-main h5 {
            font-size: 16px;
            font-weight: bold;
        }
        .receipt-main p {
            font-size: 12px;
        }
        .receipt-main h2 {
            font-size: 20px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .receipt-main .table td, .receipt-main .table th {
            padding: .75rem;
        }
        .text-danger strong {
            color: #9f181c;
        }
        .bkash-background {
            background-color: #e2136e;
            color: white;
        }
        .bkash-button {
            background-color: #e2136e;
            color: white;
        }
        .bkash-number {
            font-weight: bold;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 receipt-main border-top-red border-bottom-black">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <img class="img-fluid rounded-circle" alt="Company Logo" src="{{ asset('assets/frontend/home/images/logo.png') }}" style="width: 200px;">
                    </div>
                </div>
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
                <div class="row mb-4">
                    <div class="col-md-6 text-left">
                        <h5>{{ $data['user_name'] }}</h5>
                        <p><b>Mobile:</b> {{ $data['phone_number'] }}</p>
                        <p><b>Email:</b> {{ $data['user_email'] }}</p>
                        <p><b>Address:</b> {{ $data['address'] }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5>Auction 360</h5>
                        <p>+1 3649-6589</p>
                        <p>auction360@gmail.com</p>
                        <p>BANGLADESH</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <h3>INVOICE PAGE</h3>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Payment for Product: {{ $data['product_name'] }}</td>
                                <td>${{ $data['bid'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <p><strong>Total Amount:</strong></p>
                                    <p><strong>Payable Amount:</strong></p>
                                    <p><strong>Balance Due:</strong></p>
                                </td>
                                <td>
                                    <p><strong>${{ $data['bid'] }}</strong></p>
                                    <p><strong>$0</strong></p>
                                    <p><strong>$0</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right"><h2><strong>Total:</strong></h2></td>
                                <td class="text-left text-danger"><h2><strong>${{ $data['bid'] }}</strong></h2></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <!-- Trigger Button for Modal -->
                        <button type="button" class="btn bkash-button" data-toggle="modal" data-target="#bkashModal">
                            Pay with bKash
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p><b>Date:</b> {{ date('d M Y') }}</p>
                        <h5 style="color: #8c8c8c;">Thanks for choosing us!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bKash Payment Modal -->
    <div class="modal fade" id="bkashModal" tabindex="-1" role="dialog" aria-labelledby="bkashModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bkash-background">
                <div class="modal-header">
                    <h5 class="modal-title" id="bkashModalLabel">bKash Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/payment/{{ $data['id'] }}">
                        @csrf
                        <div class="form-group">
                            <label class="bkash-number">bKash Number: 01623388861 ( Personal )</label>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <p class="form-control-static">{{ $data['product_name'] }}</p>
                        </div>
                        <div class="form-group">
                            <label>Bid Amount</label>
                            <p class="form-control-static">${{ $data['bid'] }}</p>
                        </div>
                        <div class="form-group">
                            <label for="userBkashNumber">Your bKash Number</label>
                            <input type="text" class="form-control" id="userBkashNumber" name="phone_number" placeholder="Enter your bKash number" required>
                        </div>
                        <div class="form-group">
                            <label for="transactionId">Transaction ID</label>
                            <input type="text" class="form-control" id="transactionId" name="transaction_id" placeholder="Enter transaction ID" required>
                        </div>
                        <input type="hidden" name="bid_id" value="{{ $data['id'] }}">
                        <input type="hidden" name="product_name" value="{{ $data['product_name'] }}">
                        <input type="hidden" name="bid_amount" value="{{ $data['bid'] }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
