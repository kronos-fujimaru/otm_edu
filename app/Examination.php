<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'title'];

    public function examinationTrainings() {
        return $this->hasMany('App\ExaminationTraining');
    }

    public function examinationProblems() {
        return $this->hasMany('App\ExaminationProblem');
    }

}
