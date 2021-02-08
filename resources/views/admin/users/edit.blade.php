@extends("app")

@section("title", "Users")
@section("page-title", "Edit User")

@section("page-content")

    <form action="{{ route("users.update", $user->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">

                        @include("templates.partials.validation-status")

                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" id="">
                                        @if($user->role == null)
                                            <option value="" selected disabled></option>
                                        @endif

                                        @foreach(\App\User::ROLES as $role)
                                            <option value="{{ $role }}" @if($user->role === $role) selected @endif>{{ strtoupper($role) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button class="btn btn-success text-white px-30">
                                Save
                            </button>
                            <a href="../" class="btn text-muted">
                                <i>Cancel</i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
