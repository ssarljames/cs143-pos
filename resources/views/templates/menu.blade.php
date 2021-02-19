@php

    $menu = [
        [
            "label" => "Dashboard",
            "route" => "/",
            "icon" => "nc-icon nc-bank"
        ],
        [
            "label" => "Transactions",
            "route" => route("transactions.index"),
            "icon" => "nc-icon nc-cart-simple"
        ],
        [
            "label" => "Inventory",
            "route" => route("inventory"),
            "icon" => "nc-icon nc-box"
        ],
        [
            "label" => "Customers",
            "route" => route("customers.index"),
            "icon" => "fa fa-users"
        ],
        [
            "label" => "Users",
            "route" => route("users.index"),
            "icon" => "fa fa-user-secret"
        ],
    ];

@endphp


<ul class="nav">
    @foreach($menu as $m)
        <li class="{{ check_if_menu_is_active($m["route"]) ? ' active' : '' }}">
            <a href="{{ $m["route"] }}">
                <i class="{{ $m["icon"] }}"></i>
                <p>{{ $m["label"] }}</p>
            </a>
        </li>
    @endforeach
</ul>
