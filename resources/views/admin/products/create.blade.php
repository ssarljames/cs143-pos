@extends("app")

@section("page-title", "Create Product")

@section("page-content")
    <form action="{{ route("products.store") }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">

                @include("templates.partials.validation-status")

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old("name") }}"
                                   placeholder="Type product name">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" name="price" value="{{ old("price") }}"
                                   placeholder="Type product price">
                        </div>
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <select name="unit_type" class="form-control" id="">
                                @if(old("unit_type") === null)
                                    <option value="" selected disabled>Select Unit Type</option>
                                @endif

                                @foreach(\App\Models\Product::UNIT_TYPES as $type => $label)
                                    <option value="{{ $type }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" class="form-control" id="">
                                @if(old("category_id") === null)
                                    <option value="" selected disabled>Select Category</option>
                                @endif

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Available Stock</label>
                            <input type="text" class="form-control" name="available_stock" value="{{ old("available_stock") }}"
                                   placeholder="Type product price">
                        </div>
                        <div class="form-group">
                            <label for="">Warn if stock is less than</label>
                            <input type="text" class="form-control" name="critical_stock" value="{{ old("critical_stock") }}"
                                   placeholder="Type product price">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                        <a href="./" class="btn btn-outline-default">
                            <i class="fa fa-remove"></i>
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
