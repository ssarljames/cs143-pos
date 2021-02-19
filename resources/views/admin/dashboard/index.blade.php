@extends("app")

@section("title", "Dashboard")
@section("page-title", "Dashboard")

@section("page-content")
    <h5>Welcome {{ auth()->user()->name }}!</h5>

    <div class="row mt-5">
        <div class="col-md-3">
            <a href="{{ route("transactions.index") }}" class="card bg-success text-light">
                <div class="card-body">
                    <h1 class="d-flex flex-row align-items-center">
                        {{ \App\Models\Transaction::count() }}
                        <i class="fa fa-shopping-cart ml-auto"></i>
                    </h1>
                    <span>Total Transactions</span>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route("inventory") }}?critical=0" class="card bg-info text-light">
                <div class="card-body">
                    <h1 class="d-flex flex-row align-items-center">
                        {{ \App\Models\Product::count() }}
                        <i class="fa fa-info-circle ml-auto"></i>
                    </h1>
                    <span>Total Products</span>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route("inventory") }}?critical=1" class="card bg-warning">
                <div class="card-body">
                    <h1 class="d-flex flex-row align-items-center">
                        {{ \App\Models\Product::criticalStock()->count() }}
                        <i class="fa fa-exclamation-circle ml-auto"></i>
                    </h1>
                    <span>Products with critical stocks</span>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route("customers.index") }}" class="card">
                <div class="card-body">
                    <h1 class="d-flex flex-row align-items-center">
                        {{ \App\Models\Customer::count() }}
                        <i class="fa fa-users ml-auto"></i>
                    </h1>
                    <span>Customers</span>
                </div>
            </a>
        </div>
    </div>

@endsection
