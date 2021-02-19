<?php /** @var \App\Models\Transaction $transaction */ ?>


<div>


    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-3">


        <div class="mr-5">
            <div class="inner-addon right-addon">
                <i class="fa fa-search text-warning"></i>
                <input wire:model="search" type="text" placeholder="Search transaction..."
                       class="form-control"/>
            </div>
        </div>
        <div class="mr-auto">
            <x-date-field name="period" range="true" :value="$period"/>
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
                    <a wire:click.prevent="sortBy('customer')" role="button" href="#">
                        Customer
                        @include('templates._sort-icon', ['field' => 'customer'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Date & Time
                        @include('templates._sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('or_number')" role="button" href="#">
                        OR Number
                        @include('templates._sort-icon', ['field' => 'or_number'])
                    </a>
                </th>
                <th class="text-center">
                    <a wire:click.prevent="sortBy('total_amount')" role="button" href="#">
                        Total
                        @include('templates._sort-icon', ['field' => 'total_amount'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('user')" role="button" href="#">
                        User
                        @include('templates._sort-icon', ['field' => 'user'])
                    </a>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->customer->name ?? "N/A" }}</td>
                    <td>{{ $transaction->created_at->format("M d, Y h:i A") }}</td>
                    <td>{{ $transaction->or_number }}</td>
                    <td class="text-right pr-5">{{ number_format($transaction->total_amount, 2) }}</td>
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


@push("livewire-scripts")

    <script>
        $(document).ready(function () {
            $(`input[name="period"]`).change(function () {
                @this.set('period', this.value);
            })
        })
    </script>

@endpush

