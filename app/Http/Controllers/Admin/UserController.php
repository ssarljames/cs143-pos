<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view("admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $success = DB::transaction(function () use (&$request) {
           User::create([
               "first_name" => $request->first_name,
               "last_name" => $request->last_name,
               "username" => $request->username,
               "password" => bcrypt($request->username),
               "role" => $request->role,
           ]);

           return true;
        });

        return $success
            ? $this->redirectWithFlashMessage("success", "created", route("users.index"))
            : $this->redirectBackDueToError();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $success = DB::transaction(function () use (&$request, &$user) {

            $data = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "username" => $request->username,
                "role" => $request->role,
            ];

            if ($request->reset_password) {
                $data["reset_password_required"] = true;
                $data["password"] = bcrypt($request->reset_password);
            }

            $user->update($data);

            return true;
        });

        return $success
            ? $this->redirectWithFlashMessage("success", "updated", route("users.index"))
            : $this->redirectBackDueToError();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
