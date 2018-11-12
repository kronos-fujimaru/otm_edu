<?php

namespace App\Http\Requests\Manager;

use App\Http\Requests\Request;
use App\User;

class CommunicationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->isManager();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|max:2000',
            'participant_id' => 'required|integer|exists:users,id'
        ];
    }
}
