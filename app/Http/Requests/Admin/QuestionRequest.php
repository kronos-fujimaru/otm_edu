<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class QuestionRequest extends Request
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
            'training_id' => 'required|integer|exists:trainings,id',
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'date' => 'required|date|min:10|max:10',
            'status' => 'required|integer|in:0,1,2',
        ];
    }
}
