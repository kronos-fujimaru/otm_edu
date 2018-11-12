<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->type == User::TYPE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Type does not allow 0 value, becase 0 is admin.
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:255|unique:users,email',
            'type' => 'required|integer|in:1,2',
            'company_id' => 'required|integer|exists:companies,id'
        ];
    }
}
