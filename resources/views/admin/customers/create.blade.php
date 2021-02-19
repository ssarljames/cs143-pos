@extends("app")

@section("page-title", "Create Customer")

@section("page-content")
    <form action="{{ route("customers.store") }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">

                @include("templates.partials.validation-status")

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old("first_name") }}">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old("last_name") }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old("address") }}">
                        </div>
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_number" value="{{ old("contact_number") }}">
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
