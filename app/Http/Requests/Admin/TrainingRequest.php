<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class TrainingRequest extends Request
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
            'title' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'date_from' => 'required|date|min:10|max:10',
            'date_to' => 'required|date|min:10|max:10',
            'instructor_id' => 'required|integer|exists:instructors,id',
            'status' => 'required|integer|in:0,1,2',
        ];
    }
}
