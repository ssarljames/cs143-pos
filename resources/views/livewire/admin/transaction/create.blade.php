<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="inner-addon right-addon border rounded">
                        <i class="fa fa-search text-warning"></i>
                        <input wire:model="search" type="text" placeholder="Search product..."
                               class="form-control"/>
                    </div>

                    <div class="position-relative">

                        <div class="loading" wire:target="search" wire:loading></div>

                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Sold By</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr wire:key="search-{{ $product["id"] }}">
                                    <td>{{ $product["name"] }}</td>
                                    <td>{{ $product["price"] }}</td>
                                    <td>{{ $product["unit_type"] }}</td>
                                    <td class="text-right">
                                        <button wire:click="addItem({{ $product["id"] }})" class="btn btn-outline-dark btn-sm ">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Items</h5>
                </div>
                <div class="card-body">

                    <div class="loading" wire:target="removeItem,addItem" wire:loading></div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-right pr-5">Price</th>
                                <th class="text-right">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $item)
                                <tr wire:key="{{ $item["product"]["id"] }}">
                                    <td>{{ $item["product"]["name"] }}</td>
                                    <td>
                                        <input wire:model="items.{{ $index }}.quantity" min="1" wire:key="quantity-{{ $item["product"]["id"] }}" type="number" class="form-control" value="{{ $item["quantity"] }}">
                                    </td>
                                    <td class="text-right pr-5">{{ $item["product"]["price"] }}</td>
                                    <td class="text-right">{{ number_format($item["quantity"] * $item["product"]["price"], 2) }}</td>
                                    <td class="text-right">
                                        <button wire:click="removeItem({{ $index }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @empty($items)
                                <tr>
                                    <td colspan="5">No items selected</td>
                                </tr>
                            @endempty
                        </tbody>
                    </table>

                    <br><br>

                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-right">Sub-Total</td>
                                <td class="text-right" style="width: 100px">{{ number_format($total * 0.88, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">VAT 12%</td>
                                <td class="text-right">{{ $total * 0.12 }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Total Amount Tendered</td>
                                <td class="text-right font-weight-bolder" style="width: 100px">{{ number_format($total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card">
                <div class="card-body">



                    @if(count($items) > 0)
                        <div class="mt-3">


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Cash</label>
                                        <input type="number" wire:model="cash" class="form-control" placeholder="Enter cash">
                                    </div>
                                </div>
                            </div>



                            <div>
                                <button class="btn btn-primary" @if($cash < $total) disabled @endif>
                                    <i class="fa fa-shopping-cart"></i>
                                    Checkout
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
