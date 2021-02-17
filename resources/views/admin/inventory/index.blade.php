@extends("app")

@section("page-title", "Inventory")

@section("page-content")

    <div class="text-right">
        <a class="btn btn-info" href="{{ route("categories.index") }}">Product Categories</a>
    </div>
@endsection
