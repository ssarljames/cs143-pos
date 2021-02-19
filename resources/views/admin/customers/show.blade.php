<?php /** @var \App\Models\Customer $customer */ ?>

@extends("app")

@section("page-title", $customer->name)


@section("page-content")

    <div class="mb-3">
        <a href="{{ route("customers.index") }}" class="text-muted">
            <i class="fa fa-angle-double-left"></i>
            Back to Customers
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h5 class="d-flex flex-row align-items-center">
                        Customer Information

                        <a href="{{ route("customers.edit", $customer->id)  }}" title="Edit customer info" class="btn btn-outline-secondary ml-auto">
                            <i class="fa fa-edit"></i>
                        </a>
                    </h5>
                    <hr>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Customer Name</td>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $customer->address }}</td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td>{{ $customer->contact_number }}</td>
                            </tr>
                            <tr>
                                <td>Since</td>
                                <td>{{ $customer->created_at->format("F d, Y") }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Customer Transactions</h5>
                </div>
                <div class="card-body">

                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>OR Number</th>
                            <th>Total Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format("M d, Y h:i A") }}</td>
                                <td>
                                    <a href="{{ route("transactions.show", $transaction->id) }}" target="_blank">{{ $transaction->or_number }}</a>
                                </td>
                                <td class="text-right">{{ number_format($transaction->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
