<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("admin.auth.login");
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        /** @var User $user */
        $user = User::query()->where("username", $request->username)->first();


        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            return redirect()->intended("/");

        }

        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->back()->withInput($request->only("username"));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function account()
    {
        $user = auth()->user();
        return view("admin.auth.account", [
            "user" => $user
        ]);
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            "username" => "required|max:50",
            "password" => "nullable|max:20|confirmed",
            "current_password" => "required",
        ]);

        /** @var User $user */
        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {


            $user->username = $request->username;

            if ($request->password) {
                $user->password = bcrypt($request->password);

                $user->reset_password_required = false;

            }

            $user->save();

            return $this->redirectWithFlashMessage("success", "updated", route("account"));
        }

        else {
            return $this->redirectBackDueToError();
        }
    }
}
