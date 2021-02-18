@extends("app")

@section("page-title", "Edit Product")

@section("page-content")
    <form action="{{ route("products.update", $product->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-6">

                @include("templates.partials.validation-status")

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                   placeholder="Type product name">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}"
                                   placeholder="Type product price">
                        </div>
                        <div class="form-group">
                            <label for="">Unit Type</label>
                            <select name="unit_type" class="form-control" id="">
                                @if($product->unit_type === null)
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
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id === $product->category_id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Available Stock</label>
                            <input type="text" class="form-control" name="available_stock" value="{{ $product->available_stock }}"
                                   placeholder="Type product price">
                        </div>
                        <div class="form-group">
                            <label for="">Warn if stock is less than</label>
                            <input type="text" class="form-control" name="critical_stock" value="{{ $product->critical_stock }}"
                                   placeholder="Type critical stock">
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
