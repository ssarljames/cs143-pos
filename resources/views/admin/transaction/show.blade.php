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

                        <a href="{{ route("transactions.edit", $transaction->id)  }}" title="Edit transaction info" class="btn btn-outline-secondary ml-auto">
                            <i class="fa fa-edit"></i>
                        </a>
                    </h5>
                    <hr>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Transaction Name</td>
                                <td>{{ $transaction->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $transaction->address }}</td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td>{{ $transaction->contact_number }}</td>
                            </tr>
                            <tr>
                                <td>Since</td>
                                <td>{{ $transaction->created_at->format("F d, Y") }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
