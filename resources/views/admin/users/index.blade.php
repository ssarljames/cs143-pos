@extends("app")

@section("title", "Users")

@section("page-title")
    <i class="fa fa-users"></i>
    Users
@endsection

@section("page-content")


    <livewire:admin.users.index/>

@endsection
