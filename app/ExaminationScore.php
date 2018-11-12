<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ExaminationProblem;

class ExaminationScore extends Model
{
    public function answerBy(ExaminationProblem $problem)
    {
        return $this->examinationAnswers->where('examination_problem_id', $problem->id)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_training_id', 'participant_id', 'score'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function examinationTraining()
    {
        return $this->belongsTo('App\ExaminationTraining');
    }

    public function examinationAnswers()
    {
        return $this->hasMany('App\ExaminationAnswer');
    }

}
