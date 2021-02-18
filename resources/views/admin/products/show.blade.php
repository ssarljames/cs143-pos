<?php /** @var \App\Models\Product $product */ ?>

@extends("app")

@section("page-title", $product->name)


@section("page-content")

    <div class="mb-3">
        <a href="{{ route("inventory") }}" class="text-muted">
            <i class="fa fa-angle-double-left"></i>
            Back to Inventory
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <h5 class="d-flex flex-row align-items-center">
                        Product Information

                        <a href="{{ route("products.edit", $product->id)  }}" title="Edit product info" class="btn btn-outline-secondary ml-auto">
                            <i class="fa fa-edit"></i>
                        </a>
                    </h5>
                    <hr>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Product Name</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Sold By</td>
                                <td>{{ $product->unit_type }}</td>
                            </tr>
                            <tr>
                                <td>Available Stocks</td>
                                <td>{{ $product->available_stock_formatted }}</td>
                            </tr>
                            <tr>
                                <td>Warn if stock is less than</td>
                                <td>{{ $product->critical_stock }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
