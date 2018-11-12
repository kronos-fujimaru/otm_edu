<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;

class RaitingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => 'max:50',
          'skill_a_comment' => 'max:2000',
          'skill_b_comment' => 'max:2000',
          'skill_c_comment' => 'max:2000',
          'skill_d_comment' => 'max:2000',
          'skill_e_comment' => 'max:2000',
          'skill_f_comment' => 'max:2000',
          'comment' => 'max:2000',
        ];
    }
}
