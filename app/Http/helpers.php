<?php


use App\User;

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
     * @return User
     */
    function currentUser()
    {
        //return Cache::remember('users', null, function () {
            return Auth::user();
        //});
    }

}



if (!function_exists("generateRandomString")) {
    /**
     * Return cached current user instance
     *
     * @param int $length
     * @return string
     */
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}


