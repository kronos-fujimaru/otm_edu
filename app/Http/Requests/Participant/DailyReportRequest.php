<?php

namespace App\Http\Requests\Participant;

use App\Http\Requests\Request;
use App\User;

class DailyReportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->isParticipant();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'date' => 'required|date|',
          'content' => 'required|string|max:2000',
          'file' => 'max:8000',
        ];
    }
}
