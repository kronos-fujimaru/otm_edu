<?php

namespace App\Http\Requests\Manager;

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
        return \Auth::user()->type == User::TYPE_MANAGER;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // TODO file
        return [
            'topic_id' => 'required|integer|exists:topics,id',
            //'user_id' => 'required|integer|exists:users,id',
            'comment' => 'required|string|max:2000',
        ];
    }
}
