<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingPasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
\Log::info('Hello World');

        return [
            'password1' => 'required|alpha_dash|min:6|max:20|same:password2',
            'password2' => 'required',
        ];
    }
}
