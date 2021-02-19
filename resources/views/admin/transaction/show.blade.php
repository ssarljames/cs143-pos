<?php /** @var \App\Models\Transaction $transaction */ ?>

@extends("app")

@section("page-title", $transaction->name)


@section("page-content")

    <div class="mb-3">
        <a href="{{ route("transactions.index") }}" class="text-muted">
            <i class="fa fa-angle-double-left"></i>
            Back to Transactions
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h5 class="d-flex flex-row align-items-center">
                        Transaction Information
                    </h5>
                    <hr>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>OR Number</td>
                                <td>{{ $transaction->or_number }}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>{{ $transaction->customer->name ?? "N/A" }}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{ $transaction->user->username }}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>P {{ number_format($transaction->total_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Transaction Date</td>
                                <td>{{ $transaction->created_at->format("F d, Y h:i A") }}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Transaction Status</td>
                                <td>
                                    {{ strtoupper($transaction->status) }}
                                    @if($transaction->status === \App\Models\Transaction::RESERVED)
                                        <div class="mt-3">
                                            <form class="no-progress" action="{{ route("transactions.update-status", $transaction->id) }}" onsubmit="return confirm('Proceed?')" method="POST">
                                                @csrf
                                                @method("PUT")

                                                @if($transaction->created_at->addDays(3)->gte(today()))
                                                    <button class="btn btn-success" name="checkout" type="submit" value="1">
                                                        <i class="fa fa-check"></i>
                                                        Checkout
                                                    </button>
                                                    <button class="btn btn-danger" type="submit" name="cancel" value="1">
                                                        <i class="fa fa-trash"></i>
                                                        Cancel Transaction
                                                    </button>
                                                @else
                                                    <div class="alert alert-danger">
                                                        <strong>Reservation Expired</strong>
                                                        <p>The transaction was reserved more than 3 days ago. It can't be checkout</p>
                                                        <button class="btn btn-danger" type="submit" name="cancel" value="1">
                                                            <i class="fa fa-trash"></i>
                                                            Cancel Transaction
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Items</h5>
                    <hr>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaction->items as $item)
                            <tr>
                                <td>
                                    <a href="{{ route("products.show", $item->product_id) }}" target="_blank">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
                                <td class="text-right pr-3">{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
