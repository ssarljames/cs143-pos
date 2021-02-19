<?php /** @var \App\Models\Customer $customer */ ?>


<div>


    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-3">

        <div class="ml-auto">
            <div class="inner-addon right-addon">
                <i class="fa fa-search text-warning"></i>
                <input wire:model="search" type="text" placeholder="Search customer..."
                       class="form-control"/>
            </div>
        </div>

        <a href="{{ route("customers.create") }}" class="btn btn-primary ml-3 ">
            <i class="fa fa-plus"></i>
            Add New Customer
        </a>

    </div>

    <div class="position-relative">

        <div class="loading" wire:loading></div>

        <table class="table">
            <thead>
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Name
                        @include('templates._sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('address')" role="button" href="#">
                        Address
                        @include('templates._sort-icon', ['field' => 'address'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('contact_number')" role="button" href="#">
                        Contact Number
                        @include('templates._sort-icon', ['field' => 'contact_number'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Since
                        @include('templates._sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('transactions_count')" role="button" href="#">
                        Transactions
                        @include('templates._sort-icon', ['field' => 'transactions_count'])
                    </a>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->contact_number }}</td>
                    <td>{{ $customer->created_at->format("F d, Y") }}</td>
                    <td class="text-center">{{ $customer->transactions_count > 0 ? $customer->transactions_count : "" }}</td>
                    <td class="text-right">
                        <a href="{{ route("customers.show", $customer->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="text-right">
            {!! $customers->links() !!}
        </div>
    </div>

</div>


