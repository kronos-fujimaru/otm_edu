<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationAnswer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_problem_id', 'examination_score_id', 'answer'];

    public function examinationProblem() {
        return $this->belongsTo('App\ExaminationProblem');
    }

    public function examinationScore() {
        return $this->belongsTo('App\ExaminationScore');
    }

}
