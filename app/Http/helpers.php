<?php




if (!function_exists("check_if_menu_is_active")) {
    function check_if_menu_is_active($url)
    {
        $url = str_replace( url("") . "/", "", urldecode($url));
        //Log::info($url);
        return request()->is("$url*");
    }
}


if (!function_exists("has_active_child_menu")) {
    function has_active_child_menu($menu)
    {
        foreach ($menu["child"] as $child) {
            if (check_if_menu_is_active($child["route"]))
                return true;
        }

        return false;
    }
}

if (!function_exists("placeholder_image")) {
    /**
     * Return placeholder image path
     *
     * @return string
     *
     */
    function placeholder_image()
    {
        return asset("/media/placeholder.svg");
    }
}

if (!function_exists("avatar_placeholder_image")) {
    /**
     * Return avatar placeholder image path
     *
     * @return string
     */
    function avatar_placeholder_image()
    {
        return asset("/media/avatars/avatar0.jpg");
    }
}

if (!function_exists("currentUser")) {
    /**
     * Return cached current user instance
     *
     * @return \App\User
     */
    function currentUser()
    {
        //return Cache::remember('users', null, function () {
            return Auth::user();
        //});
    }

}
