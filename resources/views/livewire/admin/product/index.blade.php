<?php /** @var \App\Models\Product $product */ ?>


<div>


    <div class="d-flex flex-row align-items-center border-bottom pb-3 mb-3">

        @if ($criticalOnly === false && $productsWithCriticalStock > 0)
            <div class="alert alert-warning my-0">
                <i class="fa fa-exclamation-circle"></i>
                There {{ $productsWithCriticalStock > 1 ? "are $productsWithCriticalStock products" : "is a product" }} with critical stock count. Click
                <a href="javascript:void(0)" wire:click="$set('criticalOnly', true)" class="font-weight-bold">here</a> to see those products
            </div>
        @elseif($criticalOnly)
            <div class="alert alert-light my-0">
                <i class="fa fa-info-circle"></i>
                Showing {{ $productsWithCriticalStock > 1 ? "$productsWithCriticalStock products" : "the product" }} with critical stock count.
                <a href="javascript:void(0)" class="font-weight-bold" wire:click="$set('criticalOnly', false)">Show all</a>
            </div>
        @endif

        <div class="ml-auto">
            <div class="inner-addon right-addon">
                <i class="fa fa-search text-warning"></i>
                <input wire:model="search" type="text" placeholder="Search product..."
                       class="form-control"/>
            </div>
        </div>

        <a href="{{ route("products.create") }}" class="btn btn-primary ml-3 ">
            <i class="fa fa-plus"></i>
            Add New Product
        </a>


        <a class="btn btn-outline-info" href="{{ route("categories.index") }}">Product Categories</a>

    </div>

    <div class="position-relative">

        <div class="loading" wire:loading></div>

        <table class="table">
            <thead>
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Product Name
                        @include('templates._sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th style="width: 100px">
                    <a wire:click.prevent="sortBy('price')" role="button" href="#">
                        Price
                        @include('templates._sort-icon', ['field' => 'price'])
                    </a>
                </th>
                <th style="width: 200px">
                    <a wire:click.prevent="sortBy('available_stock')" role="button" href="#">
                        Available Stock
                        @include('templates._sort-icon', ['field' => 'available_stock'])
                    </a>
                </th>
                <th style="width: 200px" class="text-center">
                    <a wire:click.prevent="sortBy('category')" role="button" href="#">
                        Category
                        @include('templates._sort-icon', ['field' => 'category'])
                    </a>
                </th>
                <th style="width: 100px"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td class="text-right pr-5">{{ $product->available_stock_formatted }}</td>
                    <td class="text-right pr-5">{{ $product->category->name }}</td>
                    <td class="text-right">
                        <a href="{{ route("products.show", $product->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="text-right">
            {!! $products->links() !!}
        </div>
    </div>

</div>


