@extends("app")

@section("title", "Users")

@section("page-title")
    <i class="fa fa-user"></i>
    Account Information
@endsection

@section("page-content")

    <form action="{{ route("account.update") }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">

                        @include("templates.partials.validation-status")

                        @include("templates.partials.status")

                        @if($user->reset_password_required)
                            <div class="alert alert-warning">
                                Please update you password to activate your account.
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" disabled placeholder="First Name" value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" disabled placeholder="Last Name" value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" id="" disabled>
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


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-success text-white px-30">
                                Update
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
