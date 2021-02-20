<div>
    @if($transactionSaved === false)
        <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="inner-addon right-addon border rounded">
                        <i class="fa fa-search text-warning"></i>
                        <input wire:model="search" id="search-product" type="text" placeholder="Search product..."
                               class="form-control"/>
                    </div>

                    <div class="position-relative">

                        <div class="loading" wire:target="search" wire:loading></div>

                        <table class="table mt-3 table-hover">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Sold By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr wire:key="search-{{ $product["id"] }}" style="cursor:pointer;" wire:click="addItem({{ $product["id"] }})" >
                                    <td>{{ $product["name"] }}</td>
                                    <td>{{ $product["price"] }}</td>
                                    <td class="text-center">{{ (int)$product["available_stock"] }}</td>
                                    <td>{{ $product["unit_type"] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">



            <div class="row">
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            @if($settingCustomer === false)

                                @if($customer === null)

                                    <span class="text-muted">No customer assigned. </span>

                                    <button class="btn btn-outline-dark btn-sm" wire:click="$set('settingCustomer', true)">Choose Customer</button>
                                @else
                                    <h5>Customer: {{ $customer["name"] }}</h5>
                                    <hr>
                                    <div class="text-right">
                                        <button class="btn btn-secondary btn-sm" wire:click="$set('settingCustomer', true)">Change</button>
                                        <button class="btn btn-outline-danger btn-sm" wire:click="$set('customer', null)">Remove</button>
                                    </div>
                                @endif


                            @else

                                <div class="inner-addon right-addon border rounded">
                                    <i class="fa fa-search text-warning"></i>
                                    <input wire:model="searchCustomer" type="text" placeholder="Search existing customer..."
                                           class="form-control"/>
                                </div>

                                @if($customers)

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customers as $customer)
                                            <tr wire:key="cust-{{ $customer["id"] }}">
                                                <td>{{ $customer["name"] }}</td>
                                                <td class="text-right">
                                                    <button class="btn btn-info btn-sm" wire:click="setCustomer({{ $customer["id"] }})">Select</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @elseif($searchCustomer)
                                    <p class="mt-3">No result for <i>"{{ $searchCustomer }}"</i> </p>
                                @endif


                                <div class="text-right">
                                    <button class="btn btn-outline-dark btn-sm" wire:click="$set('settingCustomer', false)">Cancel</button>
                                </div>



                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">



                                <div>

                                    <div class="form-group">
                                        <label class="control-label">Cash</label>
                                        <input type="number" @if(count($items) === 0) disabled @endif wire:model="cash" class="form-control" placeholder="Enter cash">
                                    </div>



                                    <div class="d-flex align-items-center">
                                        @if(count($items) > 0 && $cash >= $total)
                                            <h5>Change:  {{ number_format($cash - $total, 2)}}</h5>
                                        @endif
                                        <button wire:click="checkout" class="btn btn-primary ml-auto" @if($cash < $total || $settingCustomer || count($items) === 0) disabled @endif>
                                            <i class="fa fa-shopping-cart"></i>
                                            Checkout
                                        </button>

                                        @if(count($items) > 0 && $customer !== null && $settingCustomer === false && empty($cash))
                                            <button wire:click="checkout(true)" class="btn btn-warning ml-1" >
                                                <i class="fa fa-address-book"></i>
                                                Reserve
                                            </button>
                                        @endif
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

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
                                    <td class="align-top">{{ $item["product"]["name"] }}</td>
                                    <td class="align-top">
                                        <input wire:model="items.{{ $index }}.quantity" min="1" wire:key="quantity-{{ $item["product"]["id"] }}" type="number" class="form-control @if($lackOfStockProductId === $item["product"]["id"]) is-invalid @endif" value="{{ $item["quantity"] }}">
                                        @if($lackOfStockProductId === $item["product"]["id"])
                                            <small class="text-danger">Only {{ $item["product"]["available_stock_formatted"] }} units are available</small>
                                        @endif
                                    </td>
                                    <td class="text-right pr-5 align-top">{{ $item["product"]["price"] }}</td>
                                    <td class="text-right align-top">{{ number_format($item["quantity"] * $item["product"]["price"], 2) }}</td>
                                    <td class="text-right align-top">
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
        </div>
    </div>

    @else
        <div class="alert alert-success">
            <h3>Success!</h3>
            <p>Transaction successfully saved.</p>

            <br><br>
            <button class="btn btn-primary" wire:click="$set('transactionSaved', false)">Okay</button>
        </div>
    @endif
</div>


@push("livewire-scripts")
    <script>

        window._initCreateTransactionComponent = false;

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {

                if (window._initCreateTransactionComponent === false) {
                    @this.on('focusSearchProduct', () => {
                        $("#search-product").focus()
                    });
                    window._initCreateTransactionComponent = true;
                }
            })
        });
    </script>
@endpush
