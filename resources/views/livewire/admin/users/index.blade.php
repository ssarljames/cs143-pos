<div>

    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-3">

        <div class="ml-auto">
            <div class="inner-addon right-addon">
                <i class="fa fa-search text-warning"></i>
                <input wire:model="search" type="text" placeholder="Search user..."
                       class="form-control"/>
            </div>
        </div>

        <a href="{{ route("users.create") }}" class="btn btn-primary ml-3 ">
            <i class="fa fa-plus"></i>
            New User
        </a>

    </div>

    <div class="block">
        <div class="block-content">

            @include("templates.partials.status")

            <div class="position-relative table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <a wire:click.prevent="sortBy('last_name')" role="button" href="#">
                                Last Name
                                @include('templates._sort-icon', ['field' => 'last_name'])
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('first_name')" role="button" href="#">
                                First Name
                                @include('templates._sort-icon', ['field' => 'first_name'])
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('username')" role="button" href="#">
                                Username
                                @include('templates._sort-icon', ['field' => 'username'])
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('role')" role="button" href="#">
                                Role
                                @include('templates._sort-icon', ['field' => 'role'])
                            </a>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ strtoupper($user->role) }}</td>
                            <td>
                                <a class="btn" href="{{ route("users.edit", $user->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn delete-button" data-delete-listener="deleteItem"
                                        data-id="{{ $user->id }}">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="loading" wire:loading></div>

                <div class="text-right">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@push("livewire-scripts")
    @include("templates.partials.livewireDeleteConfirmation")
@endpush
