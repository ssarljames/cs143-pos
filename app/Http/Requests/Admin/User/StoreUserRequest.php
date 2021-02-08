<?php

namespace App\Http\Requests\Admin\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed username
 * @property mixed role
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name" => "required|max:50",
            "last_name" => "required|max:50",
            "username" => "required|max:50|unique:users,username",
            "role" => "required|in:" . implode(",", User::ROLES),
        ];
    }
}
