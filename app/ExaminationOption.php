<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminationOption extends Model
{
    use SoftDeletes;

    const SIZE = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_problem_id', 'examination_option', 'order'];

    public function examinationProblem() {
        return $this->belongsTo('App\ExaminationProblem');
    }

}
