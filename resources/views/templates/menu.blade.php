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
            "icon" => "nc-icon nc-box",
            "role" => [\App\User::MANAGER,\App\User::ADMIN]
        ],
        [
            "label" => "Customers",
            "route" => route("customers.index"),
            "icon" => "fa fa-users",
            "role" => [\App\User::MANAGER,\App\User::ADMIN]
        ],
        [
            "label" => "Users",
            "route" => route("users.index"),
            "icon" => "fa fa-user-secret",
            "role" => [\App\User::ADMIN]
        ],
    ];

    $user = auth()->user();

@endphp


<ul class="nav">
    @foreach($menu as $m)
        @if(isset($m["role"]) === false || array_search($user->role, $m["role"]) !== false)
            <li class="{{ check_if_menu_is_active($m["route"]) ? ' active' : '' }}">
                <a href="{{ $m["route"] }}">
                    <i class="{{ $m["icon"] }}"></i>
                    <p>{{ $m["label"] }}</p>
                </a>
            </li>
        @endif
    @endforeach
</ul>
