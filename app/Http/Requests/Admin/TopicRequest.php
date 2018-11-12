<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class TopicRequest extends Request
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
        return [
            // 'user_id' => 'required|integer|exists:users,id',
            'company_id' => 'required|integer|exists:companies,id',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ];
    }
}
