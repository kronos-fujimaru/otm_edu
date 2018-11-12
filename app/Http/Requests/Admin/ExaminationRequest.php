<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;
use App\ExaminationProblem;
use App\ExaminationOption;

class ExaminationRequest extends Request
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
        $rules = [];
        $rules['title'] = 'required|max:100';

        for($a = 1; $a <= ExaminationProblem::SIZE; $a++) {
            $rules["problem$a"] = 'required|max:500';
            $rules["source$a"] = 'max:2000';
            $rules["answer$a"] = 'required';

            for($b = 1; $b <= ExaminationOption::SIZE; $b++) {
                $rules["option$a$b"] = 'required|max:100';
            }
        }

        return $rules;
    }
}
