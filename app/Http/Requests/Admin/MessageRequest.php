<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class MessageRequest extends Request
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
            'topic_id' => 'required|integer|exists:topics,id',
            'comment' => 'required|string|max:2000',
        ];
    }
}
