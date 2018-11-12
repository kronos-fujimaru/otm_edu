<?php

namespace App\Http\Requests\Manager;

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
          'manager_comment' => 'max:2000',
        ];
    }
}
