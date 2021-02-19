<?php /** @var \App\Models\Transaction $transaction */ ?>


<div>


    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-3">

        <div class="ml-auto">
            <div class="inner-addon right-addon">
                <i class="fa fa-search text-warning"></i>
                <input wire:model="search" type="text" placeholder="Search transaction..."
                       class="form-control"/>
            </div>
        </div>

        <a href="{{ route("transactions.create") }}" class="btn btn-primary ml-3 ">
            <i class="fa fa-plus"></i>
            Add New Transaction
        </a>

    </div>

    <div class="position-relative">

        <div class="loading" wire:loading></div>

        <table class="table">
            <thead>
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Customer
                        @include('templates._sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('address')" role="button" href="#">
                        Date & Time
                        @include('templates._sort-icon', ['field' => 'address'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('contact_number')" role="button" href="#">
                        OR Number
                        @include('templates._sort-icon', ['field' => 'contact_number'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        User
                        @include('templates._sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->created_at->format("M d, Y h:i A") }}</td>
                    <td>{{ $transaction->or_number }}</td>
                    <td>{{ $transaction->user->username }}</td>
                    <td class="text-right">
                        <a href="{{ route("transactions.show", $transaction->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="text-right">
            {!! $transactions->links() !!}
        </div>
    </div>

</div>


