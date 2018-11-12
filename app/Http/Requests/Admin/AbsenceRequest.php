<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

use App\User;

class AbsenceRequest extends Request
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
            'participant_id' => 'required|integer|exists:participants,id',
            'type' => 'required|integer|in:0,1,2',
            'date' => 'required|date|min:10|max:10',
            'hours' => 'integer|between:0,24',
            'reason' => 'required|string|max:255',
        ];
    }
}
